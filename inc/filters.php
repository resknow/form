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

        // Enable Honeypot field
        if ( array_key_exists('honeypot', $form) && $form['honeypot'] !== false ) {
            if ( array_key_exists('how', $form['fields']) ) {
                throw new Exception('Form "'. $id .'" has a field with the key "how". This key is reserved for the Honeypot field.');
            }
            
            $forms[$id]['fields']['how'] = [
                'label'     => 'If you are a human, do not fill in this field.',
                'type'      => 'text',
                'filter'    => 'trim|sanitize_string'
            ];
        }
    }

    return $forms;

} );