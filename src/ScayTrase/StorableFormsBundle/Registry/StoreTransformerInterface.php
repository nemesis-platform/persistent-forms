<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-05-25
 * Time: 22:43
 */

namespace ScayTrase\StorableFormsBundle\Registry;

use ScayTrase\StorableFormsBundle\Entity\AbstractField;
use ScayTrase\StorableFormsBundle\Entity\FieldValue;

interface StoreTransformerInterface
{
    /**
     * @param FieldValue $stored
     *
     * @return mixed
     */
    public function transformStoredToModel(FieldValue $stored);

    /**
     * @param AbstractField $field
     * @param mixed         $model
     *
     * @return FieldValue
     */
    public function transformModelToStored(AbstractField $field, $model);
}
