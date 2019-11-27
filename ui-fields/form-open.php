<?php $action = get('site.forms.' . $variables['form_id'] . '.location', '/' . get('page.slug')); ?>
<form class="bpf" action="<?= $action ?>" method="post" data-form>
    <input type="hidden" name="bp-form-id" value="<?= $variables['form_id'] ?>">
    <?php if ( get('site.recaptcha') ): ?><input type="hidden" name="bp-form-recaptcha-response" id="recaptcha-response"><?php endif; ?>

    <?php if ( $alerts = get('form.alerts') ): ?>
        <div class="form-alerts">
            <?php foreach ( $alerts as $alert ): ?>
            <div class="form-alert <?php echo $alert['type']; ?>"><?php echo $alert['message']; ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>