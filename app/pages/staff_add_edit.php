<?php
if (isset($_POST['savedata'])) {
    if (!isset($_POST['vards'])) {
        echo "<div class='alert alert-danger' role='alert'>First name is required</div>";
    } else if (!isset($_POST['uzvards'])) {
        echo "<div class='alert alert-danger' role='alert'>Last name is required</div>";
    } else if (!isset($_POST['username'])) {
        echo "<div class='alert alert-danger' role='alert'>Username is required</div>";
    } else {
        $vards = $_POST['vards'];
        $uzvards = $_POST['uzvards'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $is_admin = isset($_POST['is_admin']) ? 1 : 0;
        $is_staff = isset($_POST['is_staff']) ? 1 : 0;
        $is_active = isset($_POST['is_active']) ? 1 : 0;

        if (isset($staff_id)) {
            Flight::db()->runQuery("UPDATE darbinieki_user SET vards = ?, uzvards = ?, username = ?, admin = ?, staff = ?, is_active = ? WHERE id = ?", [$vards, $uzvards, $username, $is_admin, $is_staff, $is_active, $staff_id]);
        } else {
            Flight::db()->runQuery("INSERT INTO darbinieki_user (vards,uzvards,username,admin,staff,is_active) VALUES (?,?,?,?,?,?)", [$vards, $uzvards, $username, $is_admin, $is_staff, $is_active]);
        }
        if (isset($password)) {
            $password = Flight::make_django_password($password);
            Flight::db()->runQuery("UPDATE darbinieki_user SET password = ? WHERE id = ?", [$password, $staff_id]);
        }

        echo "<div class='alert alert-success' role='alert'>Data saved</div>";
        Flight::redirect(Flight::create_full_url('all_staff_members'));
    }
}
if (isset($staff_id)) {
    $staff_member = Flight::db()->fetchRow("SELECT * FROM darbinieki_user WHERE id = :id", ['id' => $staff_id]);
} else {
    $staff_member = array('id' => '', 'vards' => '', 'uzvards' => '', 'username' => '', 'admin' => 0, 'is_active' => 0, 'staff' => 0);
}

?>
<form method="post" class="w-25">
    <div class="form-group">
        <label for="vards">First name</label>
        <input type="text" class="form-control" id="vards" name="vards" value="<?= $staff_member['vards'] ?>" required>
    </div>
    <div class="form-group">
        <label for="uzvards">Last name</label>
        <input type="text" class="form-control" id="uzvards" name="uzvards" value="<?= $staff_member['uzvards'] ?>" required>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="<?= $staff_member['username'] ?>" required>
    </div>
    <?php if (isset($staff_id)) { ?>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
    <?php } else { ?>
        <div class="form-group">
            <i>You can set password only after creating an account!</i>
        </div>
    <?php } ?>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" value="1" <?= ($staff_member['admin'] == 1 ? "checked" : "") ?>>
        <label class="form-check-label" for="is_admin">Is admin?</label>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="is_staff" name="is_staff" value="1" <?= ($staff_member['staff'] == 1 ? "checked" : "") ?>>
        <label class="form-check-label" for="is_admin">Is staff?</label>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" <?= ($staff_member['is_active'] == 1 ? "checked" : "") ?>>
        <label class="form-check-label" for="is_active">Is active?</label>
    </div>
    <button type="submit" class="btn btn-primary" name="savedata">Save</button>
</form>