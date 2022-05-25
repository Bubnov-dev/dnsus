<?php
/**
 * WHMCS SDK Sample Addon Module
 *
 * An addon module allows you to add additional functionality to WHMCS. It
 * can provide both client and admin facing user interfaces, as well as
 * utilise hook functionality within WHMCS.
 *
 * This sample file demonstrates how an addon module for WHMCS should be
 * structured and exercises all supported functionality.
 *
 * Addon Modules are stored in the /modules/addons/ directory. The module
 * name you choose must be unique, and should be all lowercase, containing
 * only letters & numbers, always starting with a letter.
 *
 * Within the module itself, all functions must be prefixed with the module
 * filename, followed by an underscore, and then the function name. For this
 * example file, the filename is "dnsus" and therefore all functions
 * begin "dnsus_".
 *
 * For more information, please refer to the online documentation.
 *
 * @see https://developers.whmcs.com/addon-modules/
 *
 * @copyright Copyright (c) WHMCS Limited 2017
 * @license http://www.whmcs.com/license/ WHMCS Eula
 */

/**
 * Require any libraries needed for the module to function.
 * require_once __DIR__ . '/path/to/library/loader.php';
 *
 * Also, perform any initialization required by the service's library.
 */

use WHMCS\Database\Capsule;
use WHMCS\Module\Addon\dnsus\Admin\AdminDispatcher;
use WHMCS\Module\Addon\dnsus\Client\ClientDispatcher;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

/**
 * Define addon module configuration parameters.
 *
 * Includes a number of required system fields including name, description,
 * author, language and version.
 *
 * Also allows you to define any configuration parameters that should be
 * presented to the user when activating and configuring the module. These
 * values are then made available in all module function calls.
 *
 * Examples of each and their possible configuration parameters are provided in
 * the fields parameter below.
 *
 * @return array
 */
function dnsus_config()
{
    return [
        // Display name for your module
        'name' => 'dnsus',
        // Description displayed within the admin interface
        'description' => 'This module provides an example WHMCS Addon Module'
            . ' which can be used as a basis for building a custom addon module.',
        // Module author name
        'author' => 'Bubnov',
        // Default language
        'language' => 'english',
        // Version number
        'version' => '1.0',
        'fields' => [
            // a text field type allows for single line text input
            'login' => [
                'FriendlyName' => 'login',
                'Type' => 'text',
                'Size' => '25',
                'Default' => '',
                'Description' => 'login for dns manager',
            ],
            // a password field type allows for masked text input
            'password' => [
                'FriendlyName' => 'password',
                'Type' => 'text',
                'Size' => '25',
                'Default' => '',
                'Description' => 'password for dns manager',
            ],
            'ip' => [
                'FriendlyName' => 'ip',
                'Type' => 'text',
                'Size' => '25',
                'Default' => '',
                'Description' => 'ip for dns manager',
            ],
        ]
    ];
}

/**
 * Activate.
 *
 * Called upon activation of the module for the first time.
 * Use this function to perform any database and schema modifications
 * required by your module.
 *
 * This function is optional.
 *
 * @see https://developers.whmcs.com/advanced/db-interaction/
 *
 * @return array Optional success/failure message
 */
function dnsus_activate()
{
    // Create custom tables and schema required by your module
    try {
        Capsule::schema()
            ->create(
                'dnsus_domains-users',
                function ($table) {
                    /** @var \Illuminate\Database\Schema\Blueprint $table */
                    $table->increments('id');
                    $table->string('domain');
                    $table->integer('client_id');
                }
            );

        return [
            // Supported values here include: success, error or info
            'status' => 'success',
            'description' => 'This is a demo module only. '
                . 'In a real module you might report a success or instruct a '
                . 'user how to get started with it here.',
        ];
    } catch (\Exception $e) {
        return [
            // Supported values here include: success, error or info
            'status' => "error",
            'description' => 'Unable to create mod_addonexample: ' . $e->getMessage(),
        ];
    }
}

/**
 * Deactivate.
 *
 * Called upon deactivation of the module.
 * Use this function to undo any database and schema modifications
 * performed by your module.
 *
 * This function is optional.
 *
 * @see https://developers.whmcs.com/advanced/db-interaction/
 *
 * @return array Optional success/failure message
 */
function dnsus_deactivate()
{
    // Undo any database and schema modifications made by your module here
    try {
        Capsule::schema()
            ->dropIfExists('dnsus_domains-users');

        return [
            // Supported values here include: success, error or info
            'status' => 'success',
            'description' => 'This is a demo module only. '
                . 'In a real module you might report a success here.',
        ];
    } catch (\Exception $e) {
        return [
            // Supported values here include: success, error or info
            "status" => "error",
            "description" => "Unable to drop dnsus_domains-users: {$e->getMessage()}",
        ];
    }
}

/**
 * Upgrade.
 *
 * Called the first time the module is accessed following an update.
 * Use this function to perform any required database and schema modifications.
 *
 * This function is optional.
 *
 * @see https://laravel.com/docs/5.2/migrations
 *
 * @return void
 */
function dnsus_upgrade($vars)
{
    $currentlyInstalledVersion = $vars['version'];

    /// Perform SQL schema changes required by the upgrade to version 1.1 of your module
    if ($currentlyInstalledVersion < 1.1) {

    }

    /// Perform SQL schema changes required by the upgrade to version 1.2 of your module
    if ($currentlyInstalledVersion < 1.2) {

    }
}

/**
 * Admin Area Output.
 *
 * Called when the addon module is accessed via the admin area.
 * Should return HTML output for display to the admin user.
 *
 * This function is optional.
 *
 * @return string
 * @see dnsus\Admin\Controller::index()
 *
 */
function dnsus_output($vars)
{
    // Get common module parameters
    $modulelink = $vars['modulelink']; // eg. dnsuss.php?module=dnsus
    $version = $vars['version']; // eg. 1.0
    $_lang = $vars['_lang']; // an array of the currently loaded language variables

    // Get module configuration parameters
    $configTextField = $vars['Text Field Name'];
    $configPasswordField = $vars['Password Field Name'];
    $configCheckboxField = $vars['Checkbox Field Name'];
    $configDropdownField = $vars['Dropdown Field Name'];
    $configRadioField = $vars['Radio Field Name'];
    $configTextareaField = $vars['Textarea Field Name'];

    // Dispatch and handle request here. What follows is a demonstration of one
    // possible way of handling this using a very basic dispatcher implementation.

    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

    $dispatcher = new AdminDispatcher();
    $response = $dispatcher->dispatch($action, $vars);
    echo $response;
}

/**
 * Admin Area Sidebar Output.
 *
 * Used to render output in the admin area sidebar.
 * This function is optional.
 *
 * @param array $vars
 *
 * @return string
 */
function dnsus_sidebar($vars)
{
    // Get common module parameters
    $modulelink = $vars['modulelink'];
    $version = $vars['version'];
    $_lang = $vars['_lang'];

    // Get module configuration parameters
    $configTextField = $vars['Text Field Name'];
    $configPasswordField = $vars['Password Field Name'];
    $configCheckboxField = $vars['Checkbox Field Name'];
    $configDropdownField = $vars['Dropdown Field Name'];
    $configRadioField = $vars['Radio Field Name'];
    $configTextareaField = $vars['Textarea Field Name'];

    $sidebar = '<p>Sidebar output HTML goes here</p>';
    return $sidebar;
}

/**
 * Client Area Output.
 *
 * Called when the addon module is accessed via the client area.
 * Should return an array of output parameters.
 *
 * This function is optional.
 *
 * @return array
 * @see dnsus\Client\Controller::index()
 *
 */
function dnsus_clientarea($vars)
{
    // Get common module parameters
    $modulelink = $vars['modulelink']; // eg. index.php?m=dnsus
    $version = $vars['version']; // eg. 1.0
    $_lang = $vars['_lang']; // an array of the currently loaded language variables

    // Get module configuration parameters
    $login = $vars['login'];
    $password = $vars['password'];
    $ip = $vars['ip'];

    dnsus_cmd_handler($vars);


    /**
     * Dispatch and handle request here. What follows is a demonstration of one
     * possible way of handling this using a very basic dispatcher implementation.
     */

    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

    $dispatcher = new ClientDispatcher();
    return $dispatcher->dispatch($action, $vars);
}

function dnsus_cmd_handler($vars)
{
    if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
        return;
    }
    if ($_POST['cmd']) {


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
        header('Content-Type: application/json; charset=utf-8');

        if ($_POST['cmd'] == 'add_domain') {

//      curl_setopt($ch, CURLOPT_POST, true);
            $url = 'https://' . $ip . '/dnsmgr?authinfo=' . $login . ':' . $password . '&out=JSONdata' .
                '&func=domain.edit' .
                '&elid=' .
                '&dtype=master' .
                '&name=' . $_POST['name'] .
                '&masterip=&ip=95.213.243.195' .
                '&email=tech%40dns1.fastfox.pro' .
                '&dnssec_turn_off_show=' .
                '&dnssec=off' .
                '&sok=ok';

        } else if ($_POST['cmd'] == 'delete_domain') {

            $url = 'https://' . $ip . '/dnsmgr?authinfo=' . $login . ':' . $password . '&out=JSONdata' .
                '&func=domain.delete' .
                '&elid=' . $_POST['name'];
        } else if ($_POST['cmd'] == 'edit_ns') {
            $url = 'https://' . $ip . '/dnsmgr?authinfo=' . $login . ':' . $password . '&out=JSONdata' .
                '&func=domain.record.edit'.
                '&elid='.$_POST['elid'].//hui.ru.%20MX%2020%20mail.hui.ru.'.
                '&plid=' . $_POST['plid'] .//hui.ru'.
                '&name=' . $_POST['name'] .//hui.ru.'.
                '&ttl=' . $_POST['ttl'] .//4600'.
                '&rtype=' . $_POST['rtype'] .//mx'.
                '&ip=' . $_POST['ip'] .
                '&domain=' . $_POST['domain'] .//mail.hui.ru.'.
                '&srvdomain='. $_POST['srvdomain'] .
                '&priority=' . $_POST['priority'] .//20'.
                '&weight=' . $_POST['weight'] .//'.
                '&port=' . $_POST['port'] .//'.
                '&value=' . $_POST['value'] .//'.
                '&email=' . $_POST['email'] .
                '&sok=ok';
                '&sok=ok';


        } else if ($_POST['cmd'] == 'add_ns') {
            $url = 'https://' . $ip . '/dnsmgr?authinfo=' . $login . ':' . $password . '&out=JSONdata' .
                '&func=domain.record.edit' .
                '&elid=' . '' .
                '&plid=' . $_POST['plid'] .//hui.ru'.
                '&name=' . $_POST['name'] .//hui.ru.'.
                '&ttl=' . $_POST['ttl'] .//4600'.
                '&rtype=' . $_POST['rtype'] .//mx'.
                '&ip=' . $_POST['ip'] .
                '&domain=' . $_POST['domain'] .//mail.hui.ru.'.
                '&srvdomain='. $_POST['srvdomain'].
                '&priority=' . $_POST['priority'] .//20'.
                '&weight=' . $_POST['weight'] .//'.
                '&port=' . $_POST['port'] .//'.
                '&value=' . $_POST['value'] .//'.
                '&email=' . $_POST['email'] .
                '&sok=ok';

        }else {
            die('{unknown_cmd: ' . $_POST['cmd'] . '}');

        }

        curl_setopt($ch, CURLOPT_URL, $url);


        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            die("{Error: " . curl_error($ch) . "}");
        }

        $response = json_decode($response, true);
        curl_close($ch);
        $response['url'] = $url;
        $response = json_encode($response);

        die($response);
    } else {
        die('{cmd: ' . $_POST['cmd'] . '}');
    }
}
