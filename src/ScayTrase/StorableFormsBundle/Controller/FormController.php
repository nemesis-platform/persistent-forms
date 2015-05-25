<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 29.09.2014
 * Time: 17:04
 */

namespace ScayTrase\StorableFormsBundle\Controller;


use Doctrine\ORM\EntityManager;
use ScayTrase\StorableFormsBundle\Entity\AbstractField;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FormController
 *
 * @package ScayTrase\StorableFormsBundle\Controller
 * @Route("/fields")
 */
class FormController extends Controller
{


    /**
     * @Route("/api/autocomplete", name="storable_forms_field_autocomplete")
     * @param Request $request
     *
     * @return Response
     */
    public function autoCompleteAction(Request $request)
    {
        if (!$request->query->get('term')) {
            return new JsonResponse(array());
        }

        /** @var EntityManager $manager */
        $manager = $this->getDoctrine()->getManager();
        $query   = $manager->getRepository('StorableFormsBundle:AbstractField')->createQueryBuilder('f')
                           ->select('f')
                           ->orWhere('f.name like :term')
                           ->orWhere('f.title like :term')
                           ->orWhere('f.help_message like :term')
                           ->setParameter('term', '%'.$request->query->get('term').'%');

        return new JsonResponse(
            array_map(
                function (AbstractField $field) {
                    return array(
                        'label' => $field->getName(),
                        'id' => $field->getID(),
                    );
                },
                $query->getQuery()->getResult()
            )
        );
    }

    /**
     * @Template()
     * @Route("/list", name="storable_forms_field_list")
     * @return Response
     */
    public function listAction()
    {
        $fields = $this->getDoctrine()->getRepository('StorableFormsBundle:AbstractField')->findAll();

        return array('fields' => $fields);
    }

    /**
     * @param Request       $request
     * @param AbstractField $field
     * @Route("/{field}/edit", name="storable_forms_field_edit")
     *
     * @return Response
     * @Template()
     */
    public function editAction(Request $request, AbstractField $field)
    {
        $form = $this->createForm('storable_field', $field)
            ->add('submit', 'submit', array('label' => 'Обновить'));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->get('session')->getFlashBag()->add('success', 'Поле успешно сохранено');

            return $this->redirect(
                $this->generateUrl('storable_forms_field_edit', array('field' => $field->getId()))
            );
        }

        return array('form' => $form->createView());
    }

    /**
     * @param Request $request
     * @Route("/create", name="storable_forms_field_create")
     * @Template()
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm('storable_field')
            ->add('submit', 'submit', array('label' => 'Сохранить'));

        $form->handleRequest($request);

        if ($form->isValid()) {

            $field = $form->getData();

            $this->getDoctrine()->getManager()->persist($field);
            $this->getDoctrine()->getManager()->flush();

            $this->get('session')->getFlashBag()->add('success', 'Поле успешно сохранено');

            return $this->redirect(
                $this->generateUrl('storable_forms_field_edit', array('field' => $field->getId()))
            );
        }

        return array('form' => $form->createView());
    }

    /**
     * @param AbstractField $field
     *
     * @return RedirectResponse
     * @Route("/{field}/delete", name="storable_forms_field_delete")
     */
    public function deleteAction(AbstractField $field)
    {
        $this->getDoctrine()->getManager()->remove($field);
        $this->getDoctrine()->getManager()->flush();

        $this->get('session')->getFlashBag()->add('success', 'Поле успешно удалено');

        return $this->redirect($this->generateUrl('storable_forms_field_list'));
    }
}
