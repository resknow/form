<?php

GUMP::add_validator( 'spam_filter', function( $field, $input, $param = null ) {

    // Store parameters
    // Add your boolean to the 'result' array
    $params = array(
        'field'     => $field,
        'input'     => $input,
        'param'     => $param,
        'result'    => [false]
    );

    // Run the filter
    $check = apply_filters( 'form.filter', $params );

    // If any are true, spam was found
    return !in_array(true, $check['result']);

} );
