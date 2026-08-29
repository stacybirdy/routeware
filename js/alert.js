jQuery(document).ready(function ($) {
    if ($('#alert').length) {
        // Set expiration time in milliseconds (2 minutes)
        const expireTime = 20 * 60 * 1000;

        // Set variables & get localstorage values
        const now  = Date.now();
        let alertSetting = localStorage.getItem('alertHide');
        let alertExpires = parseInt(localStorage.getItem('alertExpires'));

        // If settings aren't present, or alert has expired, show the alert
        if (!alertExpires || !alertSetting || now > alertExpires) {
            $('#alert').removeClass('hide');
            if (alertExpires) {
                localStorage.removeItem('alertHide');
                localStorage.removeItem('alertExpires');
            }
        }

        // Attach behavior to close button
        $('#alertClose').click(function () {
            localStorage.setItem('alertHide', true);
            localStorage.setItem('alertExpires', now + expireTime);
            $('#alert').slideUp('slow');
        });
    }
});
