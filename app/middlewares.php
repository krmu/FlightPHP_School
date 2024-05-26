<?php
class guard
{
    public function before()
    {
        if (!isset($_SESSION['USER_ID'])) {
            Flight::redirect(Flight::create_full_url('login'));
            exit();
        }
    }
    public static function is_admin()
    {
        
        if (!Flight::get_user_data('admin')) {
            Flight::redirect(Flight::create_full_url('noaccess'));
            exit();
        }
    }
    public static function is_staff()
    {
        
        if (!Flight::get_user_data('admin')) {
            if (!Flight::get_user_data('staff')) {
                Flight::redirect(Flight::create_full_url('noaccess'));
                exit();
            }
        }
    }
    public static function is_active()
    {
        if (!Flight::get_user_data('admin')) {
            if (!Flight::get_user_data('is_active')) {
                Flight::redirect(Flight::create_full_url('noaccess'));
                exit();
            }
        }
    }
}
class layout_default
{
    public function after()
    {
        Flight::render('layout_default', []);
    }
}
Flight::map('error', function (Throwable $error) {
    if(Flight::get_user_data('admin')){
        echo "<pre>";
            print_r($error);
        echo "</pre>";
    }else{
        echo "<div style='color:red' role='alert'>An error occurred!</div>";
    }
     
});
Flight::map('notFound', function () {
    echo "<div style='color:red' role='alert'>Page not found!</div>";
});
Flight::before('start', function () {
    Flight::response()->header('X-Frame-Options', 'SAMEORIGIN');
    Flight::response()->header('X-XSS-Protection', '1; mode=block');
    Flight::response()->header('X-Content-Type-Options', 'nosniff');
    Flight::response()->header('Referrer-Policy', 'no-referrer-when-downgrade');
    Flight::response()->header('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
    Flight::response()->header('Permissions-Policy', 'geolocation=()');
});
