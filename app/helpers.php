<?php

Flight::map('create_full_url', function (string $route, array $params = []) {
    if (count($params) > 0) {
        return Flight::get('main_url') . Flight::getUrl($route, $params);
    } else {
        return Flight::get('main_url') . Flight::getUrl($route);
    }
});


// https://stackoverflow.com/a/47085205
Flight::map('make_django_password', function (string $password, $iterations = 36000, $algorithm = 'sha256') {
    $salt = base64_encode(openssl_random_pseudo_bytes(9));

    $hash = hash_pbkdf2($algorithm, $password, $salt, $iterations, 32, true);

    return 'pbkdf2_' . $algorithm . '$' . $iterations . '$' . $salt . '$' . base64_encode($hash);
});

// https://stackoverflow.com/a/25969798
Flight::map('validate_django_password', function (string $dbString, string $password) {

    $pieces = explode("$", $dbString);

    $iterations = $pieces[1];
    $salt = $pieces[2];
    $old_hash = $pieces[3];

    $hash = hash_pbkdf2("SHA256", $password, $salt, $iterations, 0, true);
    $hash = base64_encode($hash);

    if ($hash == $old_hash) {
        // login ok.
        return true;
    } else {
        //login fail       
        return false;
    }
});
// Gets user data from DB after auth
Flight::map('get_user_data', function (string $field) {
    if (isset($_SESSION['USER_ID'])) {
        $user_data = Flight::db()->fetchRow("SELECT * FROM darbinieki_user WHERE id = ? ", [$_SESSION['USER_ID']]);
        if (isset($user_data[$field])) {
            return $user_data[$field];
        } else {
            return false;
        }
    } else {
        return false;
    }
});

// All allowed grades in the system

Flight::map('allowed_grades', function ($show = false, $grade = null) {
    $grades = array('F', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
    if ($show) {
        return $grades;
    } else {
        if (in_array($grade, $grades)) {
            return true;
        } else {
            return false;
        }
    }
});
