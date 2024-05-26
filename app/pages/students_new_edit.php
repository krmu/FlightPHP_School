<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!isset($_POST['student_no'])) {
        echo "<div class='alert alert-danger' role='alert'>Student number is required</div>";
    } else if (!isset($_POST['forename'])) {
        echo "<div class='alert alert-danger' role='alert'>Name is required</div>";
    } else if (!isset($_POST['surname'])) {
        echo "<div class='alert alert-danger' role='alert'>Surname is required</div>";
    } else {
        $forename = $_POST['forename'];
        $surname = $_POST['surname'];
        $student_no_post = $_POST['student_no'];
        $aktivs = isset($_POST['aktivs']) ? 1 : 0;
        if (isset($student_no)) {
            Flight::db()->runQuery("UPDATE students SET forename = ?, surname = ?, aktivs = ? WHERE student_no = ?", [$forename, $surname, $aktivs, $student_no_post]);
        } else {
            Flight::db()->runQuery("INSERT INTO students (forename,surname,student_no,aktivs) VALUES (?,?,?,?)", [$forename, $surname, $student_no_post, $aktivs]);
        }
        echo "<div class='alert alert-success' role='alert'>Data saved</div>";
        Flight::redirect(Flight::create_full_url('students_view_all'));
    }
}

if (isset($student_no)) {
    $student_data = Flight::db()->fetchRow("SELECT * FROM students WHERE student_no = ?", [$student_no]);
} else {
    $student_data = array("forename" => "", "surname" => "", "student_no" => "", "aktivs" => 1);
}

?>
<form method="post">
    <div class="mb-3">
        <label for="forename" class="form-label"><i class="bi bi-dot"></i> Name</label>
        <input type="text" class="form-control" id="forename" name="forename" value="<?= $student_data['forename'] ?>">
    </div>
    <div class="mb-3">
        <label for="surname" class="form-label"><i class="bi bi-dot"></i> Surname</label>
        <input type="text" class="form-control" id="surname" name="surname" value="<?= $student_data['surname'] ?>">
    </div>
    <div class="mb-3">
        <label for="student_no" class="form-label"><i class="bi bi-dot"></i> Student number</label>
        <input type="text" class="form-control" id="student_no" name="student_no" value="<?= $student_data['student_no'] ?>" <?=($student_data['student_no'] != "")? 'disabled':''?>>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="aktivs" name="aktivs" value="1" <?= ($student_data['aktivs'] == 1 ? "checked" : "") ?>>
        <label class="form-check-label" for="aktivs"><i class="bi bi-dot"></i> Active</label>
    </div>
    <button type="submit" class="btn btn-outline-primary"><i class="bi bi-floppy"></i> Update data</button>
</form>