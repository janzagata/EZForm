<?php
/**
 * Created by PhpStorm.
 * User: refuse
 * Date: 16/09/18
 * Time: 21:39
 */

namespace EZForm\Service;


class UtilService
{
    public static function decodeFromJson($string) {
        $json = json_decode($string, true);
        return $json;
    }
}
