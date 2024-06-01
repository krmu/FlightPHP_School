<?php
$staff_member = new Staff();
if (isset($_POST['savedata'])) {
    if (!isset($_POST['vards'])) {
        echo "<div class='alert alert-danger' role='alert'>First name is required</div>";
    } else if (!isset($_POST['uzvards'])) {
        echo "<div class='alert alert-danger' role='alert'>Last name is required</div>";
    } else if (!isset($_POST['username'])) {
        echo "<div class='alert alert-danger' role='alert'>Username is required</div>";
    } else {
        $staff_member -> vards = $_POST['vards'];
        $staff_member -> uzvards = $_POST['uzvards'];
        $staff_member -> username = $_POST['username'];
        $staff_member -> admin = (isset($_POST['is_admin']) == 1 ? 1 : 0);
        $staff_member -> staff = (isset($_POST['is_staff']) == 1 ? 1 : 0);
        $staff_member -> is_active = (isset($_POST['is_active']) == 1 ? 1 : 0);
        if (isset($staff_id)) {
            $staff_member -> id = $staff_id;
            $staff_member -> update();
        } else {
            $staff_member -> save();
        }
        if (isset($_POST['password'])) {
            $staff_member->id = $staff_id;
            $staff_member->password = Flight::make_django_password($_POST['password']);
            $staff_member->update();
        }
        echo "<div class='alert alert-success' role='alert'>Data saved</div>";
        Flight::redirect(Flight::create_full_url('all_staff_members'));
    }
}
if (isset($staff_id)) {
    $staff_member = $staff_member->find($staff_id);
}

?>
<form method="post" class="w-25">
    <?php Flight::csfr(); ?>
    <div class="form-group">
        <label for="vards"><i class="bi bi-dot"></i> First name</label>
        <input type="text" class="form-control" id="vards" name="vards" value="<?= $staff_member->vards ?>" required>
    </div>
    <div class="form-group">
        <label for="uzvards"><i class="bi bi-dot"></i> Last name</label>
        <input type="text" class="form-control" id="uzvards" name="uzvards" value="<?= $staff_member->uzvards ?>" required>
    </div>
    <div class="form-group">
        <label for="username"><i class="bi bi-dot"></i> Username</label>
        <input type="text" class="form-control" id="username" name="username" value="<?= $staff_member->username ?>" required>
    </div>
    <?php if (isset($staff_id)) { ?>
        <div class="form-group">
            <label for="password"><i class="bi bi-dot"></i> Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
    <?php } else { ?>
        <div class="form-group">
            <i>You can set password only after creating an account!</i>
        </div>
    <?php } ?>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" value="1" <?= ($staff_member->admin == 1 ? "checked" : "") ?>>
        <label class="form-check-label" for="is_admin">Is admin?</label>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="is_staff" name="is_staff" value="1" <?= ($staff_member->staff == 1 ? "checked" : "") ?>>
        <label class="form-check-label" for="is_admin">Is staff?</label>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" <?= ($staff_member->is_active == 1 ? "checked" : "") ?>>
        <label class="form-check-label" for="is_active">Is active?</label>
    </div>
    <button type="submit" class="btn btn-outline-primary" name="savedata"><i class="bi bi-floppy"></i> Save</button>
</form>