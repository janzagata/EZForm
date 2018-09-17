<?php

use EZForm\Service as Services;
use EZForm\Model\Form;

spl_autoload_register(function ($class_name) {
    $class_name = str_replace('\\', '/', $class_name);
    include './' . $class_name . '.php';
});

$settings = new Services\SettingsService();

if (!isset($_GET['formType'])) {
    \EZForm\Service\TemplateService::renderTemplate($settings->get('template'), ['form' => 'No form specified']);
    return 0;
}

$definition = Services\UtilService::decodeFromJson(file_get_contents('./forms/' . $_GET['formType'] . '.json'));

$form = new Form($_GET['formType'], $definition, $_POST);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form->process();
    header('Location: '.$form->getRedirectTo());
} else {
    Services\TemplateService::renderTemplate($settings->get('template'), ['form' => $form->getHTML()]);
}
