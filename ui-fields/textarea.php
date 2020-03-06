<?php

// Field Setup
$_attr['name'] = $variables['name'];
$_attr['type'] = $variables['type'];
$_attr['placeholder'] = ( isset($variables['placeholder']) ? $variables['placeholder'] : null );

// Additional Attributes
$_attr['autocomplete'] = ( isset($variables['autocomplete']) ? $variables['autocomplete'] : null );
$_attr['autofocus'] = ( isset($variables['autofocus']) ? $variables['autofocus'] : null );
$_attr['min'] = ( isset($variables['min']) ? $variables['min'] : null );
$_attr['max'] = ( isset($variables['max']) ? $variables['max'] : null );
$_attr['pattern'] = ( isset($variables['pattern']) ? $variables['pattern'] : null );
$_attr['step'] = ( isset($variables['step']) ? $variables['step'] : null );
$_attr['maxlength'] = ( isset($variables['maxlength']) ? $variables['maxlength'] : null );
$_attr['readonly'] = ( isset($variables['readonly']) ? $variables['readonly'] : null );
$_attr['disabled'] = ( isset($variables['disabled']) ? $variables['disabled'] : null );

// HTML Setup
$_html['label'] = ( isset($variables['label']) ? $variables['label'] : null );
$_html['description'] = ( isset($variables['description']) ? $variables['description'] : null );
$_html['show_label'] = ( isset($variables['show_label']) ? $variables['show_label'] : true );
$_html['value'] = ( isset($variables['value']) ? $variables['value'] : null );

// Classes
$_classes = array('field-textarea');
$_classes = ( isset($variables['classes']) ? array_merge($_classes, explode(' ', $variables['classes'])) : $_classes );
$_html['classes'] = join( ' ', $_classes );

?>
<div class="field field-type-<?= $_attr['type'] ?> field-name-<?= $_attr['name'] ?>">

    <?php if ( $_html['show_label'] && $_html['label'] ): ?>
        <label for="<?= $_attr['name'] ?>"><?= $_html['label']; if ( !$variables['is-required'] ): ?> <span class="field-marker">Optional</span><?php endif; ?></label>
    <?php endif; ?>

    <textarea class="<?= $_html['classes'] ?>" <?php foreach ( $_attr as $key => $val ): if ( !$val ) continue; printf(' %s="%s"', $key, $val); endforeach; ?>><?php if ( $_html['value'] ) echo $_html['value']; ?></textarea>

    <?php if ( $_html['description'] ): ?>
    <p class="field-description"><?= $_html['description'] ?></p>
    <?php endif; ?>

</div>
