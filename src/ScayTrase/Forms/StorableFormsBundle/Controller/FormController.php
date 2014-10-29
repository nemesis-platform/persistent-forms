<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 29.09.2014
 * Time: 17:04
 */

namespace ScayTrase\Forms\StorableFormsBundle\Controller;


use Doctrine\ORM\EntityManager;
use ScayTrase\Forms\StorableFormsBundle\Entity\Field;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FormController
 * @package ScayTrase\Forms\StorableFormsBundle\Controller
 * @Route("/fields")
 */
class FormController extends Controller
{


    /**
     * @Route("/api/autocomplete", name="storable_forms_field_autocomplete")
     * @param Request $request
     * @return Response
     */
    public function autoCompleteAction(Request $request)
    {
        if (!$request->query->get('term')) {
            return new JsonResponse(array());
        }

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository('StorableFormsBundle:Field')->createQueryBuilder('f')
            ->select('f')->where('f.name like :term')->setParameter('term', '%' . $request->query->get('term') . '%');

        return new JsonResponse(
            array_map(
                function (Field $field) {
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
        $fields = $this->getDoctrine()->getRepository('StorableFormsBundle:Field')->findAll();

        return array('fields' => $fields);
    }

    /**
     * @param Request $request
     * @param Field $field
     * @Route("/{field}/edit", name="storable_forms_field_edit")
     * @return Response
     * @Template()
     */
    public function editAction(Request $request, Field $field)
    {
        $form = $this->createForm('storable_field', $field)
            ->add('submit', 'submit', array('label' => 'Обновить'));


        $form->handleRequest($request);


        if ($form->isValid()) {
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
     * @param Request $request
     * @Route("/create", name="storable_forms_field_create")
     * @Template()
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
     * @param Field $field
     * @return RedirectResponse
     * @Route("/{field}/delete", name="storable_forms_field_delete")
     */
    public function deleteAction(Field $field){
        $this->getDoctrine()->getManager()->remove($field);
        $this->getDoctrine()->getManager()->flush();

        $this->get('session')->getFlashBag()->add('success','Поле успешно удалено');

        return $this->redirect($this->generateUrl('storable_forms_field_list'));
    }
}
