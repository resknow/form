<?php

use BP\Theme;
use Form\Bundler;

/**
 * Handle Text input types
 *
 * @param string $type Field type
 */
add_filter( 'form.render.type', function( $type ) {

    // Text Types
    $text_types = [
        'password',
        'hidden',
        'tel',
        'email',
        'date',
        'datetime',
        'datetime-local',
        'url',
        'number',
        'month',
        'week',
        'time',
        'range',
        'color'
    ];

    // If current type is one of these, render it as text
    if ( in_array( $type, $text_types ) ) {
        return 'text';
    }

    return $type;

} );

/**
 * Render Form
 *
 * Renders each field in a form
 * @param string $id Form ID
 */
function render_form( $id ) {

    // Get form
    $form = get('site.forms.' . $id);
    if ( !$form ) return;

    // Set a rendered flag
    set( sprintf('site.forms.%s.rendered', $id), true );

    // Start with no HTML
    $html = [];

    // Open form element
    $html[] = render_field( $id, 'form-open' );

    // Add a title
    if ( isset($form['show_name']) && $form['show_name'] === true ) {
        $html[] = render_field( $id, 'title' );
    }

    // Render Fields
    foreach( $form['fields'] as $key => $field ) {
        $html[] = render_field( $id, $key );
    }

    // Add a submit button
    $html[] = render_field( $id, 'submit' );

    // Close form element
    $html[] = render_field( $id, 'form-close' );

    // Create one string
    return join( PHP_EOL, $html );

}

/**
 * Render Field
 *
 * Render a form HTML field
 * @param string $id Form ID
 * @param string $key Field key
 */
function render_field( $id, $key ) {

    // Stop duplicated rendering
    if ( field_has_rendered( $id, $key ) )
        return;

    // Setup theme
    $theme = new Theme( ROOT_DIR . '/_plugins/form/ui-fields' );

    // Setup Variables for this field
    $field = render_field_get_data( $id, $key );

    // Add name field
    $field['name'] = $key;

    // Check if is required
    $field['is-required'] = field_is_required($field);

    // Apply field type filters
    $type = apply_filters( 'form.render.type', $field['type'] );

    // Set template name
    $template = $type . '.php';

    // Update field state
    set_field_state( $id, $key, 'has-rendered', true );

    // Render the field
    return $theme->render($template, $field, false);

}

/**
 * Field Has Rendered
 *
 * Whether or not a field has been
 * rendered on screen yet, used mainly
 * by groups to stop duplicate rendering
 *
 * @param $id Form ID
 * @param $key Field key
 * @return bool
 */
function field_has_rendered( $id, $key ) {
    return get(sprintf('site.forms.%s.fields.%s.has-rendered', $id, $key));
}

/**
 * Set Field State
 *
 * @param $id Form ID
 * @param $key Field key
 */
function set_field_state( $id, $key, $state_key, $state_value ) {

    $_exclude = ['form-close', 'title', 'form-open', 'submit'];

    if ( !in_array( $key, $_exclude ) ) {
        $state_key = sprintf('site.forms.%s.fields.%s.%s', $id, $key, $state_key);
        return set( $state_key, $state_value );
    }

    return;

}

/**
 * Render Field Get Data
 *
 * Gets field data (attributes etc.)
 * @param string $id Form ID
 * @param string $key Field Key
 */
function render_field_get_data( $id, $key ) {

    // Get the form field
    $field = get( sprintf('site.forms.%s.fields.%s', $id, $key) );

    // Handle submit
    if ( $key === 'submit' ) {

        // Set the field manually
        $field = get( sprintf('site.forms.%s.submit', $id) );

        // Add required type attribute
        $field['type'] = 'submit';

    }

    // Handle Title field
    if ( $key === 'title' ) {

        // Set the field manually
        $field['value'] = get( sprintf('site.forms.%s.name', $id) );

        // Add classes
        $field['classes'] = get( sprintf('site.forms.%s.name_classes', $id) );

        // Add required type attribute
        $field['type'] = 'title';

    }

    // Open Form
    if ( $key === 'form-open' ) {

        // Set the form ID
        $field['form_id'] = $id;

        // Add required type attribute
        $field['type'] = 'form-open';


    }

    // Close Form
    if ( $key === 'form-close' ) {

        // Add required type attribute
        $field['type'] = 'form-close';

    }

    // Group & Section
    if ( $field['type'] === 'group' || $field['type'] === 'section' ) {

        // Set the form ID
        $field['form_id'] = $id;

    }

    // Return field
    return $field;

}

/**
 * Render Add Custom Assets
 *
 * Add custom assets for custom field types
 * @param array $field Field
 */
function render_add_custom_assets( $field, $ext ) {

    // Get Type
    $type = $field['type'];

    // Datepicker
    if ( $type === 'datepicker' ) {
        $bundle = new Bundler( '/form/datepicker-bundle' );
        $bundle->addFile( 'pikaday', 'https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/pikaday.min.js' );
        $bundle->addFile( 'datepicker', sprintf( '_plugins/form/assets/js/form.datepicker%sjs', $ext ) );
        add_stylesheet( 'form-pikaday-css', 'https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/css/pikaday.min.css' );
        add_script( 'form-datepicker-js', '/form/datepicker-bundle' );
    }

    // Choices
    if ( $type === 'choice' ) {
        add_stylesheet( 'form-choice-css', '/_plugins/form/assets/css/form.choice.css' );
        add_script( 'form-choice-js', sprintf( '/_plugins/form/assets/js/form.choice%sjs', $ext ) );
    }

    // Wysiwyg
    if ( $type === 'wysiwyg' ) {
        add_stylesheet( 'form-wysiwyg-css', 'https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css' );
        add_script( 'form-wysiwyg-js', 'https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js' );
    }

    // Conditional Field
    if ( $type === 'group' && array_key_exists('condition', $field) ) {
        add_script( 'form-conditional-js', sprintf( '/_plugins/form/assets/js/form.conditional%sjs', $ext ) );
    }

}

/**
 * Field Is Required
 *
 * @param $field Field array
 * @return bool
 */
function field_is_required( $field ) {

    // Get validation rules
    $validation = ( array_key_exists('validate', $field) ? $field['validate'] : false );

    // No validation rules found
    if ( !$validation ) {
        return false;
    }

    // Look for "required"
    return ( strpos($validation, 'required') !== false );

}

/**
 * Twig Integration
 */
add_action( 'twig.init', function( $twig ) {

    // Set global options for Form functions
    $options = [
        'is_safe' => ['html']
    ];

    $twig->addFunction( new Twig\TwigFunction('render_form', 'render_form', $options) );
    $twig->addFunction( new Twig\TwigFunction('render_field', 'render_field', $options) );
} );

/**
 * Render Attributes
 * 
 * @param array $attributes
 */
function render_attributes( $attributes = [] ) {

    foreach ( $attributes as $key => $val ) {
        if ( is_null($val) ) continue;
        $html[] = sprintf(' %s="%s"', $key, $val);
    }

    return join(' ', $html);
}