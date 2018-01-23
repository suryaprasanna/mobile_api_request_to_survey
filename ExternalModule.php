<?php
/**
 * @file
 * Provides ExternalModule class for Route Mobile Api Token Requests to Survey.
 */

namespace RouteMobileApiTokenRequestsToSurvey\ExternalModule;

use ExternalModules\AbstractExternalModule;
use ExternalModules\ExternalModules;
use Form;

/**
 * ExternalModule class for Route Mobile Api Token Requests to Survey.
 */
class ExternalModule extends AbstractExternalModule {

    /**
     * @inheritdoc
     */
    function redcap_every_page_top($project_id) {
        if (PAGE == 'MobileApp/index.php' && $project_id) {

            $url = $this->getSystemSetting('route-mobile-api-token-requests-to-survey-url');
            $text = $this->getSystemSetting('route-mobile-api-token-requests-to-survey-text');
            
            $this->sendVarToJS('routeMobileApiRequestURL', $url);
        	$this->sendVarToJS('routeMobileApiRequestText', $text);

            $this->includeJs('js/addText.js');
        }
    }


    /**
     * Includes a local JS file.
     *
     * @param string $path
     *   The relative path to the js file.
     */
    protected function includeJs($path) {
        echo '<script src="' . $this->getUrl($path) . '"></script>';
    }


    /**
     * Sends a PHP variable over to JS.
     *
     * @param string $name
     *   Variable name
     * @param var $value
     *   Variable value
     */
    protected function sendVarToJS($name, $value) {
        echo '<script>var '. $name .' = ' . json_encode($value) . ';</script>';
    }
}
