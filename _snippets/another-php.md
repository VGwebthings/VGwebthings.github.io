---
---
```php
<?php
add_action('init', function () {
    if ( ! is_admin() && $_SERVER['REMOTE_ADDR'] != '') {
        write_log($_SERVER['REMOTE_ADDR'] . ' tried to view the frontend. ' . $_SERVER['REQUEST_URI']);
        wp_redirect(admin_url(), 403);
        exit;
    }
});
```
<script src="https://gist.github.com/Mallinanga/ec160eb3608e846b317f.js"></script>
