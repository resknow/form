<?php

// Classes to add to each button
$_classes = array('form-title');
$_classes = ( isset($variables['classes']) ? array_merge($_classes, explode(' ', $variables['classes'])) : $_classes );
$_attr['classes'] = join( ' ', $_classes );

?>

<h1 class="<?= $_attr['classes'] ?>"><?= $variables['value'] ?></h1>
