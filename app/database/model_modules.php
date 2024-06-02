<?php 
/**
 * Database model for the table `modules`
 * 
 * 
 * 
 * @property int    $id
 * @property string $module_code
 * @property string $module_name
 * @property bool   $var_atzimes
 * @property bool   $aktivs
 */ 
class Modules extends flight\ActiveRecord {
    public function __construct()
    {
        parent::__construct(Flight::db(), 'modules',[ 'primaryKey' => 'module_code' ]);
    }
}