<?php
/**
 * User: scaytrase
 * Created: 2016-05-03 19:07
 */

namespace ScayTrase\StoredFormsBundle\Tests\Field;

use ScayTrase\StoredFormsBundle\Entity\Field\AbstractField;
use ScayTrase\StoredFormsBundle\Entity\Field\Type\ChoiceField;
use ScayTrase\StoredFormsBundle\Tests\AbstractFieldTest;

class ChoiceFieldTest extends AbstractFieldTest
{

    public function getTestData()
    {
        return [
            'Choice' => [['id1', 'id2'], ['id1', 'id2']],
        ];
    }

    /**
     * @param $alias
     *
     * @return AbstractField
     */
    protected function getField($alias)
    {
        $field = new ChoiceField($alias);
        $field->setMultiple(true);
        $field->setChoices(['id1' => 'test1', 'id2' => 'test2', 'id3' => 'test3']);

        return $field;
    }
}
