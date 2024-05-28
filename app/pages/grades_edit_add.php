<?php
if (isset($_POST['delete'])) {
    Flight::db()->runQuery("update marks set deleted = 1 where id = ?", [$_POST['grade_id']]);
    Flight::redirect(Flight::create_full_url("students_grades_overview"));
}
if (isset($_POST['updategrade'])) {
    $grade_information = Flight::db()->fetchRow("SELECT id FROM marks where deleted=0 and module_code = ? and student_no = ?", [$module_code, $student_no]);
    if (!isset($grade_information['id'])) {
        if (Flight::allowed_grades(false, $_POST['mark'])) {
            Flight::db()->runQuery("INSERT INTO marks (module_code,student_no,mark,last_staff,last_update,deleted) VALUES (?,?,?,?,?,0)", [$module_code, $student_no, $_POST['mark'], Flight::get_user_data('id'), time()]);
            echo "<div class='alert alert-success' role='alert'>Grade successfuly added</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Invalid grade!</div>";
        }
    } else {
        if (Flight::allowed_grades(false, $_POST['mark'])) {
            Flight::db()->runQuery("UPDATE marks set mark = ?, last_update = ?, last_staff = ? where id=?", [$_POST['mark'], time(), Flight::get_user_data('id'), $_POST['grade_id']]);
            echo "<div class='alert alert-success' role='alert'>Grade successfuly updated</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Invalid grade!</div>";
        }
    }
}
$module_information = Flight::db()->fetchRow("SELECT * FROM modules where module_code = ?", array($module_code));
$student_information = Flight::db()->fetchRow("SELECT * FROM students where student_no = ?", array($student_no));
$grade_information = Flight::db()->fetchRow("SELECT marks.id as grid,mark,last_update,uzvards,vards FROM marks left join darbinieki_user on marks.last_staff = darbinieki_user.id where module_code = ? and student_no = ? and deleted = 0", array($module_code, $student_no));
if(isset($grade_information['mark'])){
    ?>
    <form method="post">
        <input type="hidden" name="grade_id" value="<?= $grade_information['grid'] ?>">
        <button type="submit" name="delete" class="btn btn-outline-danger"><i class="bi bi-trash"></i> Delete this grade</button>
    </form>
<?php
}  

?>
<a href="<?=Flight::create_full_url("students_grades_overview")?> ">Back</a>
<div class="row">
    <div class="col-md-6">
        <form action="" method="post">
            <?php 
                if(isset($grade_information['mark'])){ echo "<input type='hidden' name='grade_id' value='".$grade_information['grid']."'>"; }
            Flight::csfr();
            ?>
            <div class="mb-3">
                <label for="student_no" class="form-label "><i class="bi bi-dot"></i> Student number</label>
                <input type="text" class="form-control" id="student_no" value="<?= $student_no ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="module_code" class="form-label "><i class="bi bi-dot"></i> Module code</label>
                <input type="text" class="form-control" id="module_code" value="<?= $module_code ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="module_name" class="form-label "><i class="bi bi-dot"></i> Module name</label>
                <input type="text" class="form-control" id="module_name" value="<?= $module_information['module_name'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="forename" class="form-label "><i class="bi bi-dot"></i> Student name</label>
                <input type="text" class="form-control" id="forename" value="<?= $student_information['forename'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="surname" class="form-label "><i class="bi bi-dot"></i> Student surname</label>
                <input type="text" class="form-control" id="surname" value="<?= $student_information['surname'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="mark" class="form-label "><i class="bi bi-dot"></i> Grade</label>
                <select class="form-select" id="mark" name="mark">
                    <?php
                        foreach (Flight::allowed_grades(true) as $grade) {
                            echo "<option value='$grade' " . ($grade_information['mark'] == $grade ? "selected" : "") . ">$grade</option>";
                        }
                    ?>
                </select>
            </div>
            <button type="submit" name="updategrade" class="btn btn-outline-primary"><i class="bi bi-floppy"></i> Update data</button>
        </form>
    </div>
    <div class="col-md-6">
    <h3>Grade history</h3>
        <?php

        $grade_history = Flight::db()->fetchAll("SELECT mark,last_update,uzvards,vards FROM marks left join darbinieki_user on marks.last_staff = darbinieki_user.id where deleted = 1  and module_code = ? and student_no = ? order by last_update desc", array($module_code, $student_no));
        echo "<table class='table table-bordered'>";
        echo "<thead><tr><th>Grade</th><th>Last updated by</th><th>Last updated on</th></tr></thead>";
        echo "<tbody>";
            echo "<tr><td>" . $grade_information['mark'] . " <b>(Current)</b></td><td>" . $grade_information['vards'] . " " . $grade_information['uzvards'] . "</td><td>" . date("d.m.Y. H:i:s", $grade_information['last_update']) . "</td></tr>";
            foreach ($grade_history as $grade) {
                echo "<tr><td>" . $grade['mark'] . "</td><td>" . $grade['vards'] . " " . $grade['uzvards'] . "</td><td>" . date("d.m.Y. H:i:s", $grade['last_update']) . "</td></tr>";
            }
        echo "</tbody>";
        echo "</table>";
 
             
        ?>
    </div>
</div>

 