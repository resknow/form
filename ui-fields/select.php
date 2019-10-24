<?php

// Field Setup
$_attr['name'] = $variables['name'];
$_attr['value'] = ( isset($variables['value']) ? $variables['value'] : false );

// Additional Attributes
$_attr['disabled'] = ( isset($variables['disabled']) ? $variables['disabled'] : false );
$_attr['readonly'] = ( isset($variables['readonly']) ? $variables['readonly'] : false );

// HTML Setup
$_html['label'] = ( isset($variables['label']) ? $variables['label'] : false );
$_html['description'] = ( isset($variables['description']) ? $variables['description'] : false );
$_html['show_label'] = ( isset($variables['show_label']) ? $variables['show_label'] : true );

// Classes to add to each button
$_classes = array('field-type-select__input');
$_html['classes'] = ( isset($variables['classes']) ? array_merge($_classes, explode(' ', $variables['classes'])) : $_classes );

?>
<div class="field field-type-<?= $variables['type'] ?> field-name-<?= $_attr['name'] ?>">

    <?php if ( $_html['show_label'] && $_html['label'] ): ?>
        <label for="<?= $_attr['name'] ?>"><?= $_html['label']; if ( !$variables['is-required'] ): ?> <span class="field-marker">Optional</span><?php endif; ?></label>
    <?php endif; ?>

    <select class="<?= join('', $_html['classes']) ?>" <?php foreach ( $_attr as $key => $val ): if ( !$val ) continue; printf(' %s="%s"', $key, $val); endforeach; ?>>
        <?php foreach ( $variables['options'] as $value => $label ): ?>
        <option value="<?= $value ?>"><?= $label ?></option>
        <?php endforeach; ?>
    </select>

    <?php if ( $_html['description'] ): ?>
    <p class="field-description"><?= $_html['description'] ?></p>
    <?php endif; ?>

</div>
