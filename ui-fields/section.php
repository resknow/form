<?php

// Field Setup
$_attr['name'] = $variables['name'];
$_attr['type'] = $variables['type'];

// Classes to add to each button
$_classes = array('field-section');
$_classes = ( isset($variables['classes']) ? array_merge($_classes, explode(' ', $variables['classes'])) : $_classes );
$_attr['classes'] = join( ' ', $_classes );

// HTML Setup
$_html['label'] = ( isset($variables['label']) ? $variables['label'] : false );
$_html['description'] = ( isset($variables['description']) ? $variables['description'] : false );
$_html['show_label'] = ( isset($variables['show_label']) ? $variables['show_label'] : true );

// Field count
$field_count = count($variables['fields']);

?>
<section class="<?= $_attr['classes'] ?> --has-<?= $field_count ?>-fields">

    <?php if ( $_html['show_label'] && $_html['label'] ): ?>
        <h3 class="field-<?= $_attr['type'] ?>-title"><?= $_html['label'] ?></h3>
    <?php endif; ?>

    <?php if ( $_html['description'] ): ?>
        <p class="field-description"><?= $_html['description'] ?></p>
    <?php endif; ?>

    <div class="field-<?= $_attr['type'] ?>-items">
        <?php foreach ( $variables['fields'] as $key ): ?>
            <div class="field-<?= $_attr['type'] ?>-item">
                <?= render_field( $variables['form_id'], $key ) ?>
            </div>
        <?php endforeach; ?>
    </div>

</section>
