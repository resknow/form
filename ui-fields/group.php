<?php

// Field Setup
$_attr['name'] = $variables['name'];
$_attr['type'] = $variables['type'];

// Classes to add to each button
$_classes = array('field-group');
$_classes[] = ( isset($variables['grid']) && $variables['grid'] === false ? 'field-group--no-grid' : '' );
$_classes = ( isset($variables['classes']) ? array_merge($_classes, explode(' ', $variables['classes'])) : $_classes );
$_attr['classes'] = join( ' ', $_classes );

// HTML Setup
$_html['label'] = ( isset($variables['label']) ? $variables['label'] : false );
$_html['description'] = ( isset($variables['description']) ? $variables['description'] : false );
$_html['show_label'] = ( isset($variables['show_label']) ? $variables['show_label'] : true );

// Field count
$field_count = count($variables['fields']);

// Is this a conditional group?
$condition = ( isset($variables['condition']) ? $variables['condition'] : false );
$condition_json = json_encode($condition, JSON_PRETTY_PRINT);

?>
<div class="<?= $_attr['classes'] ?> --has-<?= $field_count ?>-fields <?php if ($condition): ?>--is-conditional<?php endif; ?>">

    <?php if ($condition): ?>
    <script type="template/json" data-condition>
        <?= $condition_json ?>
    </script>
    <?php endif; ?>

    <?php if ( $_html['show_label'] && $_html['label'] ): ?>
        <h3 class="field-<?= $_attr['type'] ?>-title"><?= $_html['label'] ?></h3>
    <?php endif; ?>

    <?php if ( $_html['description'] ): ?>
        <p class="field-description"><?= $_html['description'] ?></p>
    <?php endif; ?>

    <div class="field-<?= $_attr['type'] ?>-items">
        <?php foreach ( $variables['fields'] as $key ): ?>
            <div class="field-<?= $_attr['type'] ?>-item">
                <?php echo render_field( $variables['form_id'], $key ) ?>
            </div>
        <?php endforeach; ?>
    </div>

</div>
