<?php namespace ReBe\API;

use ReBe\API\Data\Settings;
use ReBe\API\Data\Dictionary;

/**
 * Builds data based on API endpoint call
 * @return   array
*/
class SiteDataConstructor
{

    protected $type;
    protected $data;

    public function __construct($type, $data = null) {

        $this->type = $type;
        $this->data = $data;

    }

    /**
     * Construct site configuration data output
     * @return array
    */
    public function get_site_data() {

        $settings   = Settings::site_settings();
        $dictionary = Dictionary::site_dictionary();
        $all        = array_merge($settings, $dictionary);

        switch($this->type) {
            case 'settings':
                return $settings;
                break;
            case 'dictionary':
                return $dictionary;
                break;
            case 'all':
                return $all;
                break;
            default:
                die('No such data type: ' . $this->type . '. Use `settings`, `dictionary` or `all`.');
                break;
        }
    }

}
