(function() {

    grecaptcha.ready(function () {

        // Enable submit buttons
        var submitButton = document.querySelectorAll('[data-form] button[type="submit"]');

        for (i = 0; i < submitButton.length; i++) {
            submitButton[i].removeAttribute('disabled');
        }

        grecaptcha.execute('{recaptcha_key}', { action: 'contact' }).then(function (token) {
            var recaptchaResponse = document.getElementById('recaptcha-response');
            if (recaptchaResponse !== null) recaptchaResponse.value = token;
        });

    });

})();
