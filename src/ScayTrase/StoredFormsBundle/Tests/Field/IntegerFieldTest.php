<?php
/**
 * User: scaytrase
 * Created: 2016-05-03 19:07
 */

namespace ScayTrase\StoredFormsBundle\Tests\Field;

use ScayTrase\StoredFormsBundle\Entity\Field\AbstractField;
use ScayTrase\StoredFormsBundle\Entity\Field\Type\IntegerField;
use ScayTrase\StoredFormsBundle\Tests\AbstractFieldTest;

class IntegerFieldTest extends AbstractFieldTest
{

    public function getTestData()
    {
        return [
            'Integer' => ['1', 1],
        ];
    }

    /**
     * @param $alias
     *
     * @return AbstractField
     */
    protected function getField($alias)
    {
        return new IntegerField($alias);
    }
}
