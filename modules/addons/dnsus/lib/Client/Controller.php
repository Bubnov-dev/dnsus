<?php

namespace WHMCS\Module\Addon\dnsus\Client;

/**
 * Sample Client Area Controller
 */
class Controller
{

    /**
     * Index action.
     *
     * @param array $vars Module configuration parameters
     *
     * @return array
     */
    public function index($vars)
    {
        // Get common module parameters
        $modulelink = $vars['modulelink']; // eg. dnsuss.php?module=dnsus
        $version = $vars['version']; // eg. 1.0
        $LANG = $vars['_lang']; // an array of the currently loaded language variables

        // Get module configuration parameters
        $configTextField = $vars['Text Field Name'];
        $configPasswordField = $vars['Password Field Name'];
        $configCheckboxField = $vars['Checkbox Field Name'];
        $configDropdownField = $vars['Dropdown Field Name'];
        $configRadioField = $vars['Radio Field Name'];
        $configTextareaField = $vars['Textarea Field Name'];

        return array(
            'pagetitle' => 'Sample Addon Module',
            'breadcrumb' => array(
                'index.php?m=dnsus' => 'Sample Addon Module',
            ),
            'templatefile' => 'publicpage',
            'requirelogin' => false, // Set true to restrict access to authenticated client users
            'forcessl' => false, // Deprecated as of Version 7.0. Requests will always use SSL if available.
            'vars' => array(
                'modulelink' => $modulelink,
                'configTextField' => $configTextField,
                'customVariable' => 'your own content goes here',
            ),
        );
    }

    /**
     * Secret action.
     *
     * @param array $vars Module configuration parameters
     *
     * @return array
     */
    public function secret($vars)
    {
        // Get common module parameters
        $modulelink = $vars['modulelink']; // eg. dnsuss.php?module=dnsus
        $version = $vars['version']; // eg. 1.0
        $LANG = $vars['_lang']; // an array of the currently loaded language variables

        // Get module configuration parameters
        $configTextField = $vars['Text Field Name'];
        $configPasswordField = $vars['Password Field Name'];
        $configCheckboxField = $vars['Checkbox Field Name'];
        $configDropdownField = $vars['Dropdown Field Name'];
        $configRadioField = $vars['Radio Field Name'];
        $configTextareaField = $vars['Textarea Field Name'];

        return array(
            'pagetitle' => 'Sample Addon Module',
            'breadcrumb' => array(
                'index.php?m=dnsus' => 'Sample Addon Module',
                'index.php?m=dnsus&action=secret' => 'Secret Page',
            ),
            'templatefile' => 'secretpage',
            'requirelogin' => true, // Set true to restrict access to authenticated client users
            'forcessl' => false, // Deprecated as of Version 7.0. Requests will always use SSL if available.
            'vars' => array(
                'modulelink' => $modulelink,
                'configTextField' => $_GET['id'],
                'customVariable' => 'your own content goes here',
            ),
        );
    }


    public function ns($vars)
    {
        // Get common module parameters
        $modulelink = $vars['modulelink']; // eg. dnsuss.php?module=dnsus
        $version = $vars['version']; // eg. 1.0
        $LANG = $vars['_lang']; // an array of the currently loaded language variables

        $login = $vars['login'];
        $password = $vars['password'];
        $ip = $vars['ip'];

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_HTTPHEADER => array("Content-Type: application/json",)
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, false);

        $url = 'https://' . $ip . '/dnsmgr?authinfo=' . $login . ':' . $password . '&out=JSONdata' .
            '&func=domain.record' .
            '&elid=' . $_GET['name'];

        curl_setopt($ch, CURLOPT_URL, $url);


        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            die("{Error: " . curl_error($ch) . "}");
        }

        return array(
            'pagetitle' => 'ns edit',
            'breadcrumb' => array(
                'index.php?m=dnsus' => 'Sample Addon Module',
                'index.php?m=dnsus&action=ns' => 'ns edit',
            ),
            'templatefile' => 'ns',
            'requirelogin' => true, // Set true to restrict access to authenticated client users
            'forcessl' => false, // Deprecated as of Version 7.0. Requests will always use SSL if available.
            'vars' => array(
                'modulelink' => $modulelink,
                'nses' => json_decode($response, true),
                'plid' => $_GET['name']
            ),
        );
    }
}
