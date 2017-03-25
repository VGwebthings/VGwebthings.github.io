---
tags: wordpress dashboard
---
```php
<?php
add_filter( 'enter_title_here', 'vg_enter_title_here' );
function vg_enter_title_here( $title ) {
    $screen = get_current_screen();
    if ( 'POST_TYPE' == $screen->post_type ) {
        $title = 'STRING';
    }
    return $title;
}
```
