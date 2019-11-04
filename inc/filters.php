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

    return $forms;

} );