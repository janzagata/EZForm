<?php

namespace EZForm\Model;


use EZForm\Exception\InputException;

class Field
{
    private $id;
    private $type;
    private $value;
    private $args = [];

    function __construct($definition, $value=null)
    {
        if ($definition['id'] === null) {
            throw new InputException('input missing ID');
        }

        $this->setId($definition['id']);

        if ($definition['type'] === null) {
            throw  new InputException('input missing type');
        }

        $this->setType($definition['type']);

        $this->setArgs($definition);

        $this->setValue($value);

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }



    /**
     * @return array
     */
    public function getArgs()
    {
        return $this->args;
    }

    /**
     * @param array $args
     */
    public function setArgs($args)
    {
        $this->args = $args;
    }



    public function render(){
        switch ($this->getType()) {
            case 'checkbox':
                $result = 'radio not implemented';
                break;

            case 'radio':
                $result = 'radio not implemented';
                break;

            case 'select':
                $result = "select not implemented";
                break;

            case 'textarea':
                $result = $result = '<textarea name="'.$this->getId().'" ';

                foreach ($this->getArgs() as $key => $value) {
                    $result = $result.$key.'="'.$value.'" ';
                }

                $result = $result.'>'.$this->getArgs()['value'].'</textarea>';
                break;

            default:
                $result = '<input name="'.$this->getId().'" ';

                foreach ($this->getArgs() as $key => $value) {
                    $result = $result.$key.'="'.$value.'" ';
                }

                $result = $result.' />';
                break;
        }



        return $result;

    }


}
