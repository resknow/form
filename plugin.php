<?php

use Form\Form;
use Form\JSON;

/**
 * @subpackage Form
 * @version 2.1.0
 * @package Boilerplate (4.0.0 or higher)
 * @author Chris Galbraith
 */

// Set Minimum Boilerplate Version
plugin_requires_version( 'form', '4.0.0-dev' );

// Make sure Dependencies are installed
if ( !class_exists('\\GUMP') || !class_exists('\\Medoo\\Medoo') || !class_exists('\\PHPMailer\\PHPMailer\\PHPMailer') ) {
    throw new Exception('Run <code>composer require wixel/gump:1.5.7 phpmailer/phpmailer:6.0 catfan/medoo:1.4</code> in your terminal to finish setting up Form');
}

// Add core filters
require_once __DIR__ . '/inc/filters.php';

add_action( 'init', function() {

    if ( !get('site.email') ) {
        throw new Exception( 'You must set the <code>email</code> field in your config for the Form plugin to function.' );
    }

    // Filter: form.load
    set( 'site.forms', apply_filters( 'form.load', get('site.forms') ) );

    // Make sure we have some config to work with
    if ( !get('site.forms') ) {
        return;
    }

} );

// Load Assets
require_once __DIR__ . '/inc/assets.php';

// Include Form Classes
require_once __DIR__ . '/classes/Bundler.php';
require_once __DIR__ . '/classes/Form.php';
require_once __DIR__ . '/classes/JSON.php';

// Include functions
require_once __DIR__ . '/inc/functions.php';

// Include Render functions
require_once __DIR__ . '/inc/render.php';

// Init
add_action( 'template.init', function() use ($_theme, $_path) {

    do_action( 'form.init' );

    // Validation
    if ( path_contains('validate') ) {
        require_once __DIR__ . '/inc/validate.php';
    }

    // Submission
    if ( !path_contains('validate') && path_contains('submit') || isset( $_POST['bp-form-id'] ) ) {
        require_once __DIR__ . '/inc/submit.php';
    }

    // API
    require_once __DIR__ . '/inc/api.php';

} );
