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
        // Will be fixed
        if (!Flight::get_user_data('admin')) {
            echo  1234;
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
    echo "<pre>";
    print_r($error);
    echo "</pre>";
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
