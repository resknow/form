<?php

/**
 * @NOTE This is experimental right now and I don't
 * recommend using it in production.
 */
router()->get( '/api/form/(\w+)', function($form_id) {
    $response = [
        'code'      => 200,
        'status'    => 'OK',
        'html'      => render_form($form_id)
    ];

    header('Content-type: application/json');
    echo json_encode($response); exit;
} );