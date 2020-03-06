<?php

// Field Setup
$_attr['name'] = $variables['name'];
$_attr['value'] = ( isset($variables['value']) ? $variables['value'] : null );

// Additional Attributes
$_attr['disabled'] = ( isset($variables['disabled']) ? $variables['disabled'] : null );
$_attr['readonly'] = ( isset($variables['readonly']) ? $variables['readonly'] : null );

// HTML Setup
$_html['label'] = ( isset($variables['label']) ? $variables['label'] : null );
$_html['description'] = ( isset($variables['description']) ? $variables['description'] : null );
$_html['show_label'] = ( isset($variables['show_label']) ? $variables['show_label'] : true );

// Classes to add to each button
$_classes = array('field-type-select__input');
$_html['classes'] = ( isset($variables['classes']) ? array_merge($_classes, explode(' ', $variables['classes'])) : $_classes );

?>
<div class="field field-type-<?= $variables['type'] ?> field-name-<?= $_attr['name'] ?>">

    <?php if ( $_html['show_label'] && $_html['label'] ): ?>
        <label for="<?= $_attr['name'] ?>"><?= $_html['label']; if ( !$variables['is-required'] ): ?> <span class="field-marker">Optional</span><?php endif; ?></label>
    <?php endif; ?>

    <select class="<?= join('', $_html['classes']) ?>" <?= render_attributes($_attr) ?>>
        <?php foreach ( $variables['options'] as $value => $label ): ?>
        <option value="<?= $value ?>"><?= $label ?></option>
        <?php endforeach; ?>
    </select>

    <?php if ( $_html['description'] ): ?>
    <p class="field-description"><?= $_html['description'] ?></p>
    <?php endif; ?>

</div>
