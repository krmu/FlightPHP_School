<?php
$module = new Modules();

if (isset($_POST['save_button'])) {
     if (isset($_POST['module_code']) && isset($_POST['module_name']) && isset($_POST['aktivs'])) {
        $module-> module_code = $_POST['module_code'];
        $module-> module_name = $_POST['module_name'];
        $module-> aktivs = $_POST['aktivs'];
        $module-> var_atzimes = $_POST['var_atzimes'];
        if (isset($module_code)) {
            $module->update();
        } else {
            $module->save();
        }
        //Flight::redirect(Flight::create_full_url('modules_all'));
    }else{
        echo "<div class='alert alert-danger' role='alert'>Please fill in all fields!</div>";
    }
}
if (isset($module_code)) {
    $module = $module->find($module_code);
}
?>
 
<form method="post" class="w-25">
    <?php Flight::csfr(); ?>        
    <div class="form-group">
        <label for="module_code"><i class="bi bi-dot"></i> Module code</label>
        <input type="text" class="form-control" id="module_code" name="module_code" value="<?= $module->module_code ?>" required <?=($module->module_code != "")? 'readonly':''?>>
    </div>
    <div class="form-group">
        <label for="module_name"><i class="bi bi-dot"></i> Module name</label>
        <input type="text" class="form-control" id="module_name" name="module_name" value="<?= $module->module_name ?>" required>
    </div>
    <div class="form-group">
        <label for="aktivs"><i class="bi bi-dot"></i> Active</label>
        <select class="form-select" id="aktivs" name="aktivs">
            <option value="1" <?= ($module->aktivs == 1 ? "selected" : "") ?>>Yes</option>
            <option value="0" <?= ($module->aktivs == 0 ? "selected" : "") ?>>No</option>
        </select>
    </div>
    <div class="form-group">
        <label for="aktivs"><i class="bi bi-dot"></i> Can input grades</label>
        <select class="form-select" id="var_atzimes" name="var_atzimes">
            <option value="1" <?= ($module->var_atzimes == 1 ? "selected" : "") ?>>Yes</option>
            <option value="0" <?= ($module->var_atzimes == 0 ? "selected" : "") ?>>No</option>
        </select>
    </div>
    <input type="submit" class="btn btn-outline-success m-2" name="save_button" value="Save">
</form>