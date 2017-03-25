---
tags: gravity wordpress
---
```php
<?php
add_action('wp_ajax_nopriv_vg_get_form', 'vg_get_form');
add_action('wp_ajax_vg_get_form', 'vg_get_form');
function vg_get_form()
{
    $form_id = isset($_GET['form_id']) ? absint($_GET['form_id']) : 0;
    gravity_form($form_id, false, false, false, false, true);
    die();
}
```
```js
$(document).bind('gform_confirmation_loaded', function (event, formId) {
    setTimeout(function () {
        $('.do-form-reload').fadeOut();
    }, 5000);
    setTimeout(function () {
        $.get('/wp-admin/admin-ajax.php' + '?action=vg_get_form&form_id=' + formId, function (response) {
            $('.do-form-reload').html(response).fadeIn();
        });
    }, 5500);
});
```
