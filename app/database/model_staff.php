<?php 
/**
 * Database model for the table `staff`
 * 
 * 
 * 
 * @property int    $id
 * @property string $password
 * @property string $last_login
 * @property string $username
 * @property bool   $is_active
 * @property bool   $staff
 * @property bool   $admin
 * @property string $uzvards
 * @property string $vards
 * 
 */ 
class Staff extends flight\ActiveRecord {
    public function __construct()
    {
        parent::__construct(Flight::db(), 'darbinieki_user');
    }
}