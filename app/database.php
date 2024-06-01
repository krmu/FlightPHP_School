<?php 

class Modules extends flight\ActiveRecord {
    public function __construct()
    {
        parent::__construct(Flight::db(), 'modules',[ 'primaryKey' => 'module_code' ]);
    }
}

class Students extends flight\ActiveRecord {
    public function __construct()
    {
        parent::__construct(Flight::db(), 'students', [ 'primaryKey' => 'student_no' ]);
    }
}

class Staff extends flight\ActiveRecord {
    public function __construct()
    {
        parent::__construct(Flight::db(), 'darbinieki_user');
    }
}

class Marks extends flight\ActiveRecord {
    public function __construct()
    {
        parent::__construct(Flight::db(), 'marks');
    }
}
