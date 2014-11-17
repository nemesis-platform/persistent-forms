<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 17.11.2014
 * Time: 16:41
 */

namespace ScayTrase\Forms\StorableFormsBundle\Tests;


use ScayTrase\Testing\FixtureTestCase;
use ScayTrase\Testing\KernelForTest;

abstract class StorableFormsBundleTest extends FixtureTestCase
{
    protected static function createKernel(array $options = array())
    {
        return new KernelForTest('test', true);
    }

}
 