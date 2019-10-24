<?php

// Text
$_html['text'] = ( isset($variables['text']) ? $variables['text'] : 'Send' );

// Classes
$_classes = array('form-submit');
$_html['classes'] = ( isset($variables['classes']) ? array_merge($_classes, explode(' ', $variables['classes'])) : $_classes );

?>

<div class="field field-name-submit">
    <button<?php if ( get('site.recaptcha') ): ?> disabled<?php endif; ?> type="submit" class="<?= join(' ', $_html['classes']); ?>"><?= $_html['text'] ?></button>
</div>
