<?php
/**
 * Created by PhpStorm.
 * User: refuse
 * Date: 16/09/18
 * Time: 20:28
 */

namespace EZForm\Service;


class TemplateService
{
    const SEARCH_TAG_EXPRESSION = '/\{\{\s*([A-Za-z0-9_-]*)\s*}}/';

    public static function replace($template, $dictionary)
    {
        if (preg_match_all(self::SEARCH_TAG_EXPRESSION, $template, $matches)) {
            for ($i = 0; $i < count($matches); $i++) {
                if (isset($dictionary[strtolower($matches[1][$i])])) {
                    $template = str_replace($matches[0][$i], $dictionary[strtolower($matches[1][$i])], $template);
                }
            }
        }

        return $template;
    }

    public static function renderTemplate($templateName, $dictionary)
    {
        $template = file_get_contents($templateName);
        echo self::replace($template, $dictionary);
    }
}
