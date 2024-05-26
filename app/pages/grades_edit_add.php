<?php
if (isset($_POST['delete'])) {
    Flight::db()->runQuery("DELETE FROM marks where module_code = ? and student_no = ?", [$module_code, $student_no]);
    echo "<div class='alert alert-success' role='alert'>Grade successfuly deleted</div>";
}
if (isset($_POST['updategrade'])) {
    $grade_information = Flight::db()->fetchRow("SELECT id FROM marks where module_code = ? and student_no = ?", [$module_code, $student_no]);
    if (!isset($grade_information['id'])) {
        if (Flight::allowed_grades(false, $_POST['mark'])) {
            Flight::db()->runQuery("INSERT INTO marks (module_code,student_no,mark) VALUES (?,?,?)", [$module_code, $student_no, $_POST['mark']]);
            echo "<div class='alert alert-success' role='alert'>Grade successfuly added</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Invalid grade!</div>";
        }
    } else {
        if (Flight::allowed_grades(false, $_POST['mark'])) {
            Flight::db()->runQuery("UPDATE marks set mark = ? where module_code = ? and student_no = ?", [$_POST['mark'], $module_code, $student_no]);
            echo "<div class='alert alert-success' role='alert'>Grade successfuly updated</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Invalid grade!</div>";
        }
    }
}
$module_information = Flight::db()->fetchRow("SELECT * FROM modules where module_code = ?", array($module_code));
$student_information = Flight::db()->fetchRow("SELECT * FROM students where student_no = ?", array($student_no));
$grade_information = Flight::db()->fetchRow("SELECT * FROM marks where module_code = ? and student_no = ?", array($module_code, $student_no));
?>
<a href="<?=Flight::create_full_url("students_grades_overview")?> ">Back</a>
<form action="" method="post">
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
<form method="post">
    <button type="submit" name="delete" class="btn btn-outline-danger"><i class="bi bi-trash"></i> Delete this grade</button>
</form>