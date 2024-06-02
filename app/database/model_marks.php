<?php 
/**
 * Database model for the table `marks`
 * 
 * 
 * 
 * @property int    $id
 * @property string $module_code
 * @property string $module_name
 * @property bool   $var_atzimes
 * @property bool   $aktivs
 */ 

class Marks extends flight\ActiveRecord {
    public function __construct()
    {
        parent::__construct(Flight::db(), 'marks');
    }
}