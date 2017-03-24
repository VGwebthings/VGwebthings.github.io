---
---
```php
<?php
class TheSite extends Site
{

    function __construct()
    {
        add_filter('timber_context', [$this, 'addToContext']);
        add_filter('get_twig', [$this, 'addToTwig']);
        add_action('init', [$this, 'registerPostTypes']);
        $this->setupCache();
        parent::__construct();
    }
}
```
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam quis est at turpis viverra tempus vel id augue.

### Fusce in mauris et magna elementum blandit at.

Donec placerat magna fringilla dignissim eleifend. Vestibulum at mollis nunc, vel mollis purus. Nulla dolor mi, aliquam ac elit a, vehicula sodales nibh. Nullam a arcu at lectus viverra fringilla eu ac velit. Fusce tincidunt orci quam, nec pellentesque ligula pellentesque in. Morbi dui nunc, elementum a porta vel, lacinia sit amet sapien. Donec eu blandit enim. Mauris malesuada tincidunt sapien, aliquet maximus nisi molestie eu. Cras ultricies tellus neque, nec auctor turpis lacinia non. Proin condimentum nisl at diam semper porttitor. Maecenas finibus massa tellus, a sodales est accumsan eget.

```php
<?php
use Timber\Loader;
use Timber\Menu;
use Timber\Site;
use Timber\Timber;

class TheSite extends Site
{

    function __construct()
    {
        add_filter('timber_context', [$this, 'addToContext']);
        add_filter('get_twig', [$this, 'addToTwig']);
        add_action('init', [$this, 'registerPostTypes']);
        $this->setupCache();
        parent::__construct();
    }

    function setupCache()
    {
        Timber::$cache = false;
        if (defined('WP_ENV') && 'production' === WP_ENV) {
            Timber::$cache = true;
            add_filter('timber/cache/mode', function ($cacheMode) {
                $cacheMode = Loader::CACHE_OBJECT;

                return $cacheMode;
            });
        }
    }

    function registerPostTypes()
    {
        register_extended_post_type('pharmacy', array(
            'show_in_feed' => false,
            'archive'      => array(
                'nopaging' => true,
            ),
            'public'       => false,
            'show_ui'      => true,
            'menu_icon'    => 'dashicons-heart',
            'supports'     => array('title'),
        ), array('singular' => 'Φαρμακείο', 'plural' => 'Φαρμακεία', 'slug' => 'pharmacy',));
    }

    function addToContext($context)
    {
        //$context['settings'] = get_fields('options');
        //$context['menu']     = new Menu('primary');
        if (current_theme_supports('nanga-sidebar')) {
            $context['sidebar'] = Timber::get_sidebar('sidebar.php');
        }
        $context['site'] = $this;

        return $context;
    }

    function addToTwig($twig)
    {
        // $twig->addFilter('antispam', new Twig_Filter_Function([$this, 'antispam']));
        // $twig->addExtension(new \nochso\HtmlCompressTwig\Extension(true));
        $twig->addExtension(new Twig_Extension_StringLoader());

        return $twig;
    }

    function antispam($email)
    {
        return antispambot($email);
    }
}

new TheSite();
```
