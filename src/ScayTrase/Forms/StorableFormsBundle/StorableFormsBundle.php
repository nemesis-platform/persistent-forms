<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 29.09.2014
 * Time: 13:33
 */

namespace ScayTrase\Forms\StorableFormsBundle;


use ScayTrase\Forms\StorableFormsBundle\Services\RegistryCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class StorableFormsBundle extends Bundle{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new RegistryCompilerPass());
    }
} 