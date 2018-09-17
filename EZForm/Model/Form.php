<?php
/**
 * Created by PhpStorm.
 * User: refuse
 * Date: 16/09/18
 * Time: 17:09
 */

namespace EZForm\Model;


use EZForm\Exception\FormException;
use EZForm\Processor\Processor;

class Form
{
    private $id;
    private $formType;
    private $action;
    private $redirectTo;
    private $fields;
    private $processors;

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
    public function getFormType()
    {
        return $this->formType;
    }

    /**
     * @param mixed $formType
     */
    public function setFormType($formType)
    {
        $this->formType = $formType;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getRedirectTo()
    {
        return $this->redirectTo;
    }

    /**
     * @param mixed $redirectTo
     */
    public function setRedirectTo($redirectTo)
    {
        $this->redirectTo = $redirectTo;
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
    public function getProcessors()
    {
        return $this->processors;
    }

    /**
     * @param mixed $processors
     */
    public function setProcessors($processors)
    {
        $this->processors = $processors;
    }




    public function __construct($formType, $definition, $values = [])
    {
        $this->setFormType($formType);

        if ($definition['id'] === null) {
            throw new FormException('form missing action');
        }

        $this->setId($definition['id']);

        if ($definition['action'] === null) {
            throw new FormException('form missing action');
        }

        $this->setAction($definition['action']);

        if ($definition['redirectTo'] === null) {
            throw new FormException('form missing action');
        }

        $this->setAction($definition['redirectTo']);

        // avoid notices
        if (empty($values)) {
            foreach ($definition['fields'] as $inputDefinition) {
                $this->fields[] = new Field($inputDefinition);
            }
        } else {
            foreach ($definition['fields'] as $inputDefinition) {
                $this->fields[] = new Field($inputDefinition, $values[$inputDefinition['id']]);
            }
        }



        $this->fields[] = new ServiceField($this->getFormType());
        $this->fields[] = new SubmitField();

        $this->setProcessors($definition['processors']);
    }

    public function getHTML() {
        $result = '<form id="'.$this->getId().'" action="'.$this->getAction().'?formType='.$this->getFormType().'" method="POST"> ';

        /** @var Field $field */
        foreach ($this->getFields() as $field) {
            $result = $result.$field->render();
        }

        $result = $result.'</form>';

        return $result;
    }

    public function process() {
        foreach ($this->getProcessors() as $processorClass => $settings) {
            $className = 'EZForm\Processor\\'.$processorClass;
            //TODO: catch fatal error and make it exception
            /** @var Processor $processor */
            $processor = new $className($this->getFields(), $settings);
            $processor->process();
        }

    }


}
