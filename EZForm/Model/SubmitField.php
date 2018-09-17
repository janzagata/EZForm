<?php
/**
 * Created by PhpStorm.
 * User: refuse
 * Date: 16/09/18
 * Time: 17:34
 */

namespace EZForm\Model;


use EZForm\Service\UtilService;

class SubmitField extends Field
{
    public function __construct()
    {
        $definition = '{
        "id": "submit",
        "type": "submit"}';

        parent::__construct(UtilService::decodeFromJson($definition));
    }

}
