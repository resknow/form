<?php

// Field Setup
$_attr['name'] = $variables['name'];
$_attr['type'] = $variables['type'];
$_attr['value'] = ( isset($variables['value']) ? $variables['value'] : null );
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

// Classes to add to each button
$_classes = array('field-input');
$_classes = ( isset($variables['classes']) ? array_merge($_classes, explode(' ', $variables['classes'])) : $_classes );
$_attr['class'] = join( ' ', $_classes );

?>
<div class="field field-type-<?= $_attr['type'] ?> field-name-<?= $_attr['name'] ?>">

    <label for="<?= $_attr['name'] ?>">
        <?= $_html['label']; if ( !$variables['is-required'] ): ?> <span class="field-marker">Optional</span><?php endif; ?>
        <input <?= render_attributes($_attr) ?>>
    </label>

    <?php if ( $_html['description'] ): ?>
    <p class="field-description"><?= $_html['description'] ?></p>
    <?php endif; ?>

</div>
