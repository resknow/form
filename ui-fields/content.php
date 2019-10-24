<?php

// Classes to add to the wrapper
$_classes = array('field', 'field-type-content');
$_classes = ( isset($variables['classes']) ? array_merge($_classes, explode(' ', $variables['classes'])) : $_classes );
$_attr['classes'] = join( ' ', $_classes );

// Check Type
$_type = ( isset($variables['component']) && $variables['component'] === true ? 'component' : 'get_partial' );

?>
<div class="<?= $_attr['classes'] ?>">
    <?php call_user_func( $_type, $variables['partial'] )  ?>
</div>
