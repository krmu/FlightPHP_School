<?php
$student = new Students();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!isset($_POST['student_no'])) {
        echo "<div class='alert alert-danger' role='alert'>Student number is required</div>";
    } else if (!isset($_POST['forename'])) {
        echo "<div class='alert alert-danger' role='alert'>Name is required</div>";
    } else if (!isset($_POST['surname'])) {
        echo "<div class='alert alert-danger' role='alert'>Surname is required</div>";
    } else {
        $student->student_no = $_POST['student_no'];
        $student->forename = $_POST['forename'];
        $student->surname = $_POST['surname'];
        $student->aktivs = isset($_POST['aktivs']) ? 1 : 0;
        if (isset($student_no)) {
            $student->update();
        } else {
            $student->save();
        }
        echo "<div class='alert alert-success' role='alert'>Data saved</div>";
        Flight::redirect(Flight::create_full_url('students_view_all'));
    }
}
if (isset($student_no)) {
    $student = $student->find($student_no);
}
?>
<form method="post">
    <?php Flight::csfr(); ?>
    <div class="mb-3">
        <label for="forename" class="form-label"><i class="bi bi-dot"></i> Name</label>
        <input type="text" class="form-control" id="forename" name="forename" value="<?= $student->forename ?>">
    </div>
    <div class="mb-3">
        <label for="surname" class="form-label"><i class="bi bi-dot"></i> Surname</label>
        <input type="text" class="form-control" id="surname" name="surname" value="<?= $student->surname ?>">
    </div>
    <div class="mb-3">
        <label for="student_no" class="form-label"><i class="bi bi-dot"></i> Student number</label>
        <input type="text" class="form-control" id="student_no" name="student_no" value="<?= $student->student_no ?>" <?=($student->student_no != "")? 'readonly':''?>>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="aktivs" name="aktivs" value="1" <?= ($student->aktivs == 1 ? "checked" : "") ?>>
        <label class="form-check-label" for="aktivs"><i class="bi bi-dot"></i> Active</label>
    </div>
    <button type="submit" class="btn btn-outline-primary"><i class="bi bi-floppy"></i> Update data</button>
</form>