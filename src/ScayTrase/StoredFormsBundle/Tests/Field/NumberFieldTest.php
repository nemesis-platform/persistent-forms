<?php
/**
 * User: scaytrase
 * Created: 2016-05-03 19:07
 */

namespace ScayTrase\StoredFormsBundle\Tests\Field;

use ScayTrase\StoredFormsBundle\Entity\Field\AbstractField;
use ScayTrase\StoredFormsBundle\Entity\Field\Type\NumberField;
use ScayTrase\StoredFormsBundle\Tests\AbstractFieldTest;

class NumberFieldTest extends AbstractFieldTest
{

    public function getTestData()
    {
        return [
            'Numeric' => ['1', 1.0],
        ];
    }

    /**
     * @param $alias
     *
     * @return AbstractField
     */
    protected function getField($alias)
    {
        return new NumberField($alias);
    }
}
