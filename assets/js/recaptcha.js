(function() {
    // Enable submit buttons
    var submitButtons = document.querySelectorAll(
        '[data-form] button[type="submit"]'
    );
    submitButtons.forEach(function(button) {
        button.setAttribute('disabled');
    });

    grecaptcha.ready(function() {
        submitButtons.forEach(function(button) {
            button.removeAttribute('disabled');
        });

        grecaptcha
            .execute('{recaptcha_key}', { action: 'contact' })
            .then(function(token) {
                var recaptchaResponse = document.getElementById(
                    'recaptcha-response'
                );
                if (recaptchaResponse !== null) recaptchaResponse.value = token;
            });
    });
})();
