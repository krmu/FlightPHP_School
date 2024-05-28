<?php
if (isset($_POST['save_button'])) {
    if (isset($_POST['module_code']) && isset($_POST['module_name']) && isset($_POST['aktivs'])) {
        if (isset($module_code)) {
            Flight::db()->runQuery("UPDATE modules SET module_code = :module_code, module_name = :module_name, aktivs = :aktivs WHERE module_code = :module_code", ['module_code' => $_POST['module_code'], 'module_name' => $_POST['module_name'], 'aktivs' => $_POST['aktivs']]);
        } else {
            Flight::db()->runQuery("INSERT INTO modules (module_code,module_name,aktivs,var_atzimes) VALUES (:module_code,:module_name,:aktivs,1)", ['module_code' => $_POST['module_code'], 'module_name' => $_POST['module_name'], 'aktivs' => $_POST['aktivs']]);
        }
        Flight::redirect(Flight::create_full_url('modules_all'));
    }
}
if (isset($module_code)) {
    $module = Flight::db()->fetchRow("SELECT * FROM modules WHERE module_code = :module_code", ['module_code' => $module_code]);
} else {
    $module = array('module_code' => '', 'module_name' => '', 'aktivs' => 1);
}
?>
<div class="container-sm pt-4 text-center">
    <?php Flight::csfr(); ?>
    <form method="post" class="w-25">
        <div class="form-group">
            <label for="module_code"><i class="bi bi-dot"></i> Module code</label>
            <input type="text" class="form-control" id="module_code" name="module_code" value="<?= $module['module_code'] ?>" required <?=($module['module_code'] != "")? 'disabled':''?>>
        </div>
        <div class="form-group">
            <label for="module_name"><i class="bi bi-dot"></i> Module name</label>
            <input type="text" class="form-control" id="module_name" name="module_name" value="<?= $module['module_name'] ?>" required>
        </div>
        <div class="form-group">
            <label for="aktivs"><i class="bi bi-dot"></i> Active</label>
            <select class="form-select" id="aktivs" name="aktivs">
                <option value="1" <?= ($module['aktivs'] == 1 ? "selected" : "") ?>>Yes</option>
                <option value="0" <?= ($module['aktivs'] == 0 ? "selected" : "") ?>>No</option>
            </select>
        </div>
        <input type="submit" class="btn btn-outline-success" name="save_button" value="Save">
    </form>