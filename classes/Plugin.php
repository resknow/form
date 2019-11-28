<?php

namespace Form;

use Exception;

class Plugin {

    protected $pluginDir; // Form plugin directory

    public function __construct() {
        plugin_requires_version( 'form', '4.0.0-dev' );

        // Make sure Dependencies are installed
        if ( !class_exists('\\GUMP') || !class_exists('\\Medoo\\Medoo') || !class_exists('\\PHPMailer\\PHPMailer\\PHPMailer') ) {
            throw new Exception('Run `composer require wixel/gump:1.5.7 phpmailer/phpmailer:6.0 catfan/medoo:1.4` in your terminal to finish setting up Form');
        }

        $this->pluginDir = plugin_dir() . '/form';

        add_action('init', [$this, 'init']);
        add_action('template.init', [$this, 'pathSetup']);
    }

    /**
     * Init
     * 
     * Loads configured forms and checks site config
     */
    public function init() {
    
        // Filter: form.load
        set( 'site.forms', apply_filters( 'form.load', get('site.forms') ) );
    
        // Make sure we have some config to work with
        if ( !get('site.forms') ) {
            return;
        }

        if ( !get('site.email') ) {
            throw new Exception( 'You must set the "email" field in your config for the Form plugin to function.' );
        }

    }

    /**
     * Path Setup
     * 
     * Sets up form routes for validation and submission
     */
    public function pathSetup() {

        do_action( 'form.init' );

        // Validation
        if ( path_contains('validate') ) {
            require_once $this->pluginDir . '/inc/validate.php';
        }
    
        // Submission
        if ( !path_contains('validate') && path_contains('submit') || isset( $_POST['bp-form-id'] ) ) {
            require_once $this->pluginDir . '/inc/submit.php';
        }

    }

}