<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 01.06.2015
 * Time: 10:56
 */

namespace ScayTrase\StoredFormsBundle\Tests;

use ScayTrase\StoredFormsBundle\StoredFormsBundle;
use ScayTrase\Testing\FixtureTestCase;

abstract class AbstractKernelTest extends FixtureTestCase
{
    protected static function createKernel(array $options = array())
    {
        return new TestKernel(
            'test',
            true,
            array(
                new StoredFormsBundle(),
            ),
            array(
                __DIR__.'/fixtures/config.yml'
            )
        );
    }
}
