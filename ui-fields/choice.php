<?php

// Field Setup
$_attr['name'] = $variables['name'];
$_attr['type'] = 'hidden';
$_attr['value'] = ( isset($variables['value']) ? $variables['value'] : null );

// Additional Attributes
$_attr['disabled'] = ( isset($variables['disabled']) ? $variables['disabled'] : null );

// HTML Setup
$_html['label'] = ( isset($variables['label']) ? $variables['label'] : null );
$_html['description'] = ( isset($variables['description']) ? $variables['description'] : null );
$_html['show_label'] = ( isset($variables['show_label']) ? $variables['show_label'] : true );

// Classes to add to each button
$_classes = array('field-type-choices__button');
$_html['classes'] = ( isset($variables['classes']) ? array_merge($_classes, explode(' ', $variables['classes'])) : $_classes );

?>
<div class="field field-type-<?= $variables['type'] ?> field-name-<?= $_attr['name'] ?>">

    <?php if ( $_html['show_label'] && $_html['label'] ): ?>
        <label for="<?= $_attr['name'] ?>"><?= $_html['label']; if ( !$variables['is-required'] ): ?> <span class="field-marker">Optional</span><?php endif; ?></label>
    <?php endif; ?>

    <div class="field-type-choices__list">
        <?php foreach ( $variables['options'] as $value => $label ): ?>
        <div class="<?= join( ' ', $_html['classes']) ?>" data-value="<?= $value ?>"><?= $label ?></div>
        <?php endforeach; ?>
    </div>

    <?php if ( $_html['description'] ): ?>
    <p class="field-description"><?= $_html['description'] ?></p>
    <?php endif; ?>

    <input <?= render_attributes($_attr) ?>>
</div>
