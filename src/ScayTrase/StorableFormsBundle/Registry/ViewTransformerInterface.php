<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-05-25
 * Time: 22:45
 */

namespace ScayTrase\StorableFormsBundle\Registry;

use ScayTrase\StorableFormsBundle\Entity\FieldValue;

interface ViewTransformerInterface
{
    /**
     * @param FieldValue $value
     *
     * @return mixed
     */
    public function transformStoredToView(FieldValue $value);
}
