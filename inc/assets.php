<?php

function form_get_asset_ext() {
    return $_ext = ( get('site.environment') == 'prod' ? '.min.' : '.' );
}

add_action( 'assets.loaded', function() {

    $_ext = form_get_asset_ext();

    // Plugin CSS
    add_stylesheet( 'form-css', sprintf( '/_plugins/form/assets/css/form%scss', $_ext ) );

    // Plugin JS
    add_script( 'form-js', sprintf( '/_plugins/form/assets/js/form%sjs', $_ext ) );

    if ( get('site.recaptcha') ) {
        add_script( 'form-recaptcha', sprintf('https://www.google.com/recaptcha/api.js?render=%s', get('site.recaptcha.key')) );
    }

} );

add_action( 'template.footer', function() {

    // Load Google ReCaptcha
    if ( get('site.recaptcha') ) {

        $recap = file_get_contents( '_plugins/form/assets/js/recaptcha.js' );
        $recap = str_replace( '{recaptcha_key}', get('site.recaptcha.key'), $recap );

        printf( '<script>%s</script>', $recap );

    }

} );

/**
 * Handle custom input type assets
 *
 * Forms that are altered after the initial
 * init action will not be found by this
 */
add_action( 'form.init', function() {

    $_ext = form_get_asset_ext();

    // Get forms
    $forms = get('site.forms');

    // Custom Types
    $custom = apply_filters( 'form.customTypes', array(
        'datepicker', 'choice', 'wysiwyg', 'group'
    ) );

    // Look in each forms fields for custom types
    foreach ( $forms as $form ) {
        foreach ( $form['fields'] as $field ) {

            // Look for a custom type
            foreach ( $custom as $type ) {
                if ( $field['type'] === $type ) {
                    render_add_custom_assets($field, $_ext);
                }
            }

            continue;

        }
    }

    return $forms;

} );
