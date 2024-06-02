<?php 
/**
 * Database model for the table `students`
 * 
 * 
 * 
 * @property int    $id
 * @property string $surname
 * @property string $forename
 * @property string $student_no
 * @property bool   $aktivs
 */ 

class Students extends flight\ActiveRecord {
    public function __construct()
    {
        parent::__construct(Flight::db(), 'students', [ 'primaryKey' => 'student_no' ]);
    }
}