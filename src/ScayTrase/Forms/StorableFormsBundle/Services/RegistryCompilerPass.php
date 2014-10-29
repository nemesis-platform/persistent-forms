<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 29.09.2014
 * Time: 17:42
 */

namespace ScayTrase\Forms\StorableFormsBundle\Services;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class RegistryCompilerPass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('storable_forms.services.forms_registry')) {
            return;
        }

        $defenition = $container->getDefinition('storable_forms.services.forms_registry');

        $menuServices = $container->findTaggedServiceIds('storable_field');

        foreach ($menuServices as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {
                $defenition->addMethodCall(
                    'registerField',
                    array(new Reference($id))
                );
            }
        }

    }
}