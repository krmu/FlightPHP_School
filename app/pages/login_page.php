<?php


if (isset($_POST['auth_button'])) {
    if (!isset($_POST['username']) || !isset($_POST['password'])) {
        echo "<div class='alert alert-danger'>Please fill in all fields!</div>";
    } else {
        $staff = new Staff();
        $staff->select('id','password')->eq('username', $_POST['username'])->find();
        if (isset($staff->id)) {
            if (Flight::validate_django_password($staff->password, $_POST['password'])) {
                $_SESSION['USER_ID'] = $staff->id;
                $_SESSION['csrf-token'] = bin2hex(random_bytes(128));
                $staff->last_login = date("d.m.Y. H:i:s");
                $staff->save();
                Flight::redirect(Flight::create_full_url('home'));
            } else {
                echo "<div class='alert alert-danger'>Incorrect password!</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Incorrect username or password!</div>";
        }
    }
}
?>
<div class="row justify-content-center">
    <div class="col-5 text-center">
        <h1>Login</h1>
        <p>Enter your username and password to log in</p>
        <p>Default users:</p>
        <p>
            admin:password
            teacher:teacher
        </p>
        <form method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <br>
            <input type="submit" class="btn btn-success" name="auth_button" value="Authorize">
        </form>
    </div>  
</div>
     