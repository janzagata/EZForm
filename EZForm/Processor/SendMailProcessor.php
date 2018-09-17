<?php
/**
 * Created by PhpStorm.
 * User: refuse
 * Date: 17/09/18
 * Time: 08:47
 */

namespace EZForm\Processor;


use EZForm\Service\TemplateService;

class SendMailProcessor extends Processor
{
    public function __construct($fields, $settings)
    {
        if (!isset($settings['address']) || !isset($settings['subject']) || !isset($settings['message'])) {
            throw new \Exception('processor missconfigured');
        }
        parent::__construct($fields, $settings);
    }

    public function process()
    {
        $address = $this->getSetting('address');
        $subject = $this->getSetting('subject');
        $message = TemplateService::replace($this->getSetting('message'), $this->getDictionary());

        if ($this->getSetting('debug')) {
            echo $message;
        } else {
            mail( $address, $subject, $message);
        }



    }
}
