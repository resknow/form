<?php

use Form\Form;
use Form\JSON;

/**
 * This is accessed by sending post data
 * to /submit/<formid> and will set
 * alerts using get('form.alerts')
 *
 * On success, an alert will be set. If the
 * 'location.success' option is set in the config
 * they will redirected to that URL
 */

// Get Form ID
$_id = ( isset( $_POST['bp-form-id'] ) ? $_POST['bp-form-id'] : get('page.index.1') );

// Remove ID from $_POST
if ( isset( $_POST['bp-form-id'] ) ) {
    unset($_POST['bp-form-id']);
}

// Get Form
$_form = new Form( get('site'), $_id );

// Check for a Form ID
if ( !$_id || !$_form->form_exists($_id) ) {

    // Set Alert
    set( 'form.alerts.invalid', array(
        'type'      => 'negative',
        'message'   => 'Invalid Form ID'
    ) );

} else {

    // Check for POST Data
    if ( !is_form_data() ) {

        // Set Alert
        set( 'form.alerts.bad-data', array(
            'type'      => 'negative',
            'message'   => 'No form input'
        ) );

    } else {

        // Run Validation
        $_valid = $_form->validate( form_data() );

        // Assume not spam until Recaptcha says otherwise
        $_is_spam = false;

        // Check ReCaptcha is setup
        if ( get('site.recaptcha') ) {

            if ( !isset($_POST['bp-form-recaptcha-response']) || empty($_POST['bp-form-recaptcha-response']) ) {
                set( 'form.alerts.recaptcha-error', array(
                    'type'      => 'negative',
                    'message'   => 'Recaptcha response not found'
                ) );

                $_valid = false;
                $_is_spam = true;
            } else {
                // Get Recaptcha Score
                $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
                $recaptcha_secret = get('site.recaptcha.secret');
                $recaptcha_response = $_POST['bp-form-recaptcha-response'];
                $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
                $recaptcha = json_decode($recaptcha);

                // Get Min Score
                $min_score = get('site.recaptcha.min_score', 0.5);

                // Take action based on the score returned:
                if ( $recaptcha->score < $min_score ) {
                    $_valid = false;
                    $_is_spam = true;
                }

                // Clean up
                unset( $_POST['bp-form-recaptcha-response'], $_valid['bp-form-recaptcha-response'] );
            }

        }

        // If there are errors, set an alert
        if ( !$_valid ) {

            // Create HTML
            $_html = '';

            // Create HTML Errors
            if ( is_array($_form->errors()) ) {
                foreach ( $_form->errors() as $name => $error ) {
                    $_html .= sprintf('<p>%s</p>', $error);
                }
            }

            // If spam, add the error
            if ( $_is_spam ) {
                $_html .= sprintf('<p>%s</p>', 'Your message has been flagged as spam.');
            }

            // Build Response
            set( 'form.alerts.errors', array(
                'type'      => 'negative',
                'message'   => $_html
            ) );

        } else {

            if ( $_form->process( $_valid ) ) {

                // Build Response
                set( 'form.alerts.success', array(
                    'type'      => 'positive',
                    'message'   => ( $_form->success_message ? $_form->success_message : 'Your message has been sent.' )
                ) );

            } else {

                // Create HTML
                $_html = '';

                // Create HTML Errors
                foreach ( $_form->errors() as $name => $error ) {
                    $_html .= sprintf('<p>%s</p>', $error);
                }

                // Build Response
                set( 'form.alerts.errors', array(
                    'type'      => 'negative',
                    'message'   => $_html
                ) );

            }

        }

    }

}
