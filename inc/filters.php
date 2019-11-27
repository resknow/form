<?php

/**
 * Check the 'config' key to make sure it's not form
 */
add_filter( 'form.load', function( $forms ) {

    if ( array_key_exists('config', $forms) ) {
        $is_form = [
            array_key_exists('name', $forms['config']),
            array_key_exists('fields', $forms['config'])
        ];

        if ( in_array(true, $is_form) ) {
            throw new Exception('The config key is reserved for Form plugin configuration, you cannot use it as a form name.');
        }
    }

    // Check all forms for required config
    foreach ( $forms as $id => $form ) {
        if ( $id === 'config' ) continue;

        // Name
        if ( !array_key_exists('name', $form) ) throw new Exception('Form "'. $id .'" must have a name.');

        // Fields
        foreach ( $form['fields'] as $key => $field ) {
            if ( !array_key_exists('label', $field) ) throw new Exception('Form "'. $id .'" field "'. $key .'" must have a label.');
            if ( !array_key_exists('type', $field) ) throw new Exception('Form "'. $id .'" field "'. $key .'" must have a type.');
        }
    }

    return $forms;

} );