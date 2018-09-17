<?php

namespace EZForm\Service;

class SettingsService
{
    const SETTINGS_STRINGS = [
        'template'
    ];

    const OPTIONAL_SETTINGS_STRINGS = [

    ];

    private $settings = [];

    public function __construct()
    {
        include 'ezform_settings.php';

        foreach (self::SETTINGS_STRINGS as $setting) {
            if(!isset(${$setting})){
                throw new \Exception('mandatory setting '.$setting.' not found');
            }
            $this->settings[$setting] = ${$setting};
        }

        foreach (self::OPTIONAL_SETTINGS_STRINGS as $setting => $value) {
            if(!isset(${$setting})){
                $this->settings[$setting] = $value;
            } else {
                $this->settings[$setting] = ${$setting};
            }
        }

    }

    public function get($settingString) {
        if(isset($this->settings[$settingString])){
            return $this->settings[$settingString];
        } else {
            throw new \Exception($settingString . ' not found in settings');
        }
    }

}
