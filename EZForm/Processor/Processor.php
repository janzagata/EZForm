<?php
/**
 * Created by PhpStorm.
 * User: refuse
 * Date: 16/09/18
 * Time: 22:27
 */

namespace EZForm\Processor;


use EZForm\Model\Field;

abstract class Processor
{
    private $fields;
    private $settings;

    public function __construct($fields, $settings) {
        $this->fields = $fields;
        $this->settings = $settings;
    }

    public abstract function process();

    function getDictionary() {
        $dictionary = [];
        /** @var Field $field */
        foreach ($this->fields as $field) {
            $dictionary[$field->getId()] = $field->getValue();
        }
        return $dictionary;
    }

    /**
     * @return mixed
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param mixed $fields
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
    }

    /**
     * @return mixed
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @param mixed $settings
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;
    }

    public function getSetting($key) {
        return $this->getSettings()[$key];
    }



}
