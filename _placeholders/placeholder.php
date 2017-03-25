<?php
header("HTTP/1.1 404 Not Found");
header("Status: 404 Not Found");
$blog  = get_bloginfo('name');
$site  = get_bloginfo('url') . '/';
$email = get_bloginfo('admin_email');
if ( ! empty($_COOKIE["nkthemeswitch" . COOKIEHASH])) {
    $theme = clean($_COOKIE["nkthemeswitch" . COOKIEHASH]);
} else {
    $theme_data = wp_get_theme();
    $theme      = clean($theme_data->Name);
}
if (isset($_SERVER['HTTP_REFERER'])) {
    $referer = clean($_SERVER['HTTP_REFERER']);
} else {
    $referer = "undefined";
}
if (isset($_SERVER['REQUEST_URI']) && isset($_SERVER["HTTP_HOST"])) {
    $request = clean('http://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
} else {
    $request = "undefined";
}
if (isset($_SERVER['QUERY_STRING'])) {
    $string = clean($_SERVER['QUERY_STRING']);
} else {
    $string = "undefined";
}
if (isset($_SERVER['REMOTE_ADDR'])) {
    $address = clean($_SERVER['REMOTE_ADDR']);
} else {
    $address = "undefined";
}
if (isset($_SERVER['HTTP_USER_AGENT'])) {
    $agent = clean($_SERVER['HTTP_USER_AGENT']);
} else {
    $agent = "undefined";
}
if (isset($_SERVER['REMOTE_IDENT'])) {
    $remote = clean($_SERVER['REMOTE_IDENT']);
} else {
    $remote = "undefined";
}
$time = clean(date("F jS Y, h:ia", time()));
function clean($string)
{
    $string = rtrim($string);
    $string = ltrim($string);
    $string = htmlentities($string, ENT_QUOTES);
    $string = str_replace("\n", "<br>", $string);
    if (get_magic_quotes_gpc()) {
        $string = stripslashes($string);
    }

    return $string;
}

$message = "TIME: " . $time . "\n" . "*404: " . $request . "\n" . "SITE: " . $site . "\n" . "THEME: " . $theme . "\n" . "REFERRER: " . $referer . "\n" . "QUERY STRING: " . $string . "\n" . "REMOTE ADDRESS: " . $address . "\n" . "REMOTE IDENTITY: " . $remote . "\n" . "USER AGENT: " . $agent . "\n\n\n";
mail($email, "404 Alert: " . $blog . " [" . $theme . "]", $message, "From: $email");
