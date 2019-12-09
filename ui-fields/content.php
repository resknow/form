<?php

// Classes to add to the wrapper
$_classes = array('field', 'field-type-content');
$_classes = ( isset($variables['classes']) ? array_merge($_classes, explode(' ', $variables['classes'])) : $_classes );
$_attr['classes'] = join( ' ', $_classes );

// Callback
$callback = ( is_callable($variables['callback']) ? $variables['callback'] : false);
if ( !$callback ) return;

?>
<div class="<?= $_attr['classes'] ?>">
   <?php call_user_func($callback) ?>
</div>
