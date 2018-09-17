<?php
/**
 * Created by PhpStorm.
 * User: refuse
 * Date: 16/09/18
 * Time: 17:34
 */

namespace EZForm\Model;

use EZForm\Service\UtilService;


class ServiceField extends Field
{
    public function __construct($formType)
    {
        $definition = '{
        "id": "formType",
        "type": "hidden",
        "value": "'.$formType.'"}';

        parent::__construct(UtilService::decodeFromJson($definition));
    }

}
