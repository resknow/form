<?php

// Field Setup
$_attr['name'] = $variables['name'];
$_attr['type'] = $variables['type'];
$_attr['value'] = ( isset($variables['value']) ? $variables['value'] : false );
$_attr['placeholder'] = ( isset($variables['placeholder']) ? $variables['placeholder'] : false );

// Additional Attributes
$_attr['autocomplete'] = ( isset($variables['autocomplete']) ? $variables['autocomplete'] : false );
$_attr['autofocus'] = ( isset($variables['autofocus']) ? $variables['autofocus'] : false );
$_attr['min'] = ( isset($variables['min']) ? $variables['min'] : false );
$_attr['max'] = ( isset($variables['max']) ? $variables['max'] : false );
$_attr['pattern'] = ( isset($variables['pattern']) ? $variables['pattern'] : false );
$_attr['step'] = ( isset($variables['step']) ? $variables['step'] : false );
$_attr['maxlength'] = ( isset($variables['maxlength']) ? $variables['maxlength'] : false );
$_attr['readonly'] = ( isset($variables['readonly']) ? $variables['readonly'] : false );
$_attr['disabled'] = ( isset($variables['disabled']) ? $variables['disabled'] : false );

// HTML Setup
$_html['label'] = ( isset($variables['label']) ? $variables['label'] : false );
$_html['description'] = ( isset($variables['description']) ? $variables['description'] : false );
$_html['show_label'] = ( isset($variables['show_label']) ? $variables['show_label'] : true );

// Classes to add to each button
$_classes = array('field-input');
$_classes = ( isset($variables['classes']) ? array_merge($_classes, explode(' ', $variables['classes'])) : $_classes );
$_attr['class'] = join( ' ', $_classes );

?>
<div class="field field-type-<?= $_attr['type'] ?> field-name-<?= $_attr['name'] ?>">

    <?php if ( $_html['show_label'] && $_html['label'] ): ?>
        <label for="<?= $_attr['name'] ?>"><?= $_html['label']; if ( !$variables['is-required'] ): ?> <span class="field-marker">Optional</span><?php endif; ?></label>
    <?php endif; ?>

    <input<?php foreach ( $_attr as $key => $val ): if ( !$val ) continue; printf(' %s="%s"', $key, $val); endforeach; ?>>

    <?php if ( $_html['description'] ): ?>
    <p class="field-description"><?= $_html['description'] ?></p>
    <?php endif; ?>

</div>
