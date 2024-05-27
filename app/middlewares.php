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
class api_guard
{
    public function before()
    {
        if (!isset($_SESSION['USER_ID']) || ($_SESSION['csrf-token'] != Flight::request()->getHeader('X-CSRF-TOKEN'))) {
            Flight::json(['error' => 'Unauthorized'], 401);
            exit();
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
