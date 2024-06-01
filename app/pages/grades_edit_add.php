<?php
$mark = new Marks();
if (isset($_POST['delete'])) {
    $mark -> deleted = 1;
    $mark -> id = $_POST['grade_id'];
    $mark -> update();
    Flight::redirect(Flight::create_full_url("students_grades_overview"));
}
if (isset($_POST['updategrade'])) {
    if (Flight::allowed_grades(false, $_POST['mark'])) {
        if (isset($_POST['grade_id'])) {
            // We update grade as deleted
            $mark = new Marks();
            $mark->id = $_POST['grade_id'];
            $mark -> deleted = 1;
            $mark -> update();
        }
        // We insert new grade
        $mark = new Marks();
        $mark -> module_code = $module_code;
        $mark -> student_no = $student_no;
        $mark -> mark = $_POST['mark'];
        $mark -> last_staff = Flight::get_user_data('id');
        $mark -> last_update = time();
        $mark -> deleted = 0;
        $mark -> insert();
       // Flight::db()->runQuery("INSERT INTO marks (module_code,student_no,mark,last_staff,last_update,deleted) VALUES (?,?,?,?,?,0)", [$module_code, $student_no, $_POST['mark'], Flight::get_user_data('id'), time()]);
        
        echo "<div class='alert alert-success' role='alert'>Grade successfuly added</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Invalid grade!</div>";
    }
}
$module_information = new Modules();
$module_information = $module_information->find($module_code);
$student_information = new Students();
$student_information = $student_information->find($student_no);

$grade_information = $mark->select('marks.id as grid','mark','last_update','uzvards','vards')->join('darbinieki_user', 'marks.last_staff = darbinieki_user.id')->eq('module_code', $module_code)->eq('student_no', $student_no)->ne('deleted', 1)->find();
if(isset($grade_information->mark)){
    ?>
    <form method="post">
        <?php Flight::csfr(); ?>
        <input type="hidden" name="grade_id" value="<?= $grade_information->grid ?>">
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
                if(isset($grade_information->mark)){ echo "<input type='hidden' name='grade_id' value='".$grade_information->grid."'>"; }
                Flight::csfr();
            ?>
            <div class="mb-3">
                <label for="student_no" class="form-label "><i class="bi bi-dot"></i> Student number</label>
                <input type="text" class="form-control" id="student_no" value="<?= $student_no ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="module_code" class="form-label "><i class="bi bi-dot"></i> Module code</label>
                <input type="text" class="form-control" id="module_code" value="<?= $module_code ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="module_name" class="form-label "><i class="bi bi-dot"></i> Module name</label>
                <input type="text" class="form-control" id="module_name" value="<?= $module_information->module_name ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="forename" class="form-label "><i class="bi bi-dot"></i> Student name</label>
                <input type="text" class="form-control" id="forename" value="<?= $student_information->forename ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="surname" class="form-label "><i class="bi bi-dot"></i> Student surname</label>
                <input type="text" class="form-control" id="surname" value="<?= $student_information->surname ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="mark" class="form-label "><i class="bi bi-dot"></i> Grade</label>
                <select class="form-select" id="mark" name="mark">
                    <?php
                        echo "<option selected disabled>Select grade</option>";
                        foreach (Flight::allowed_grades(true) as $grade) echo "<option value='$grade' " . ($grade_information->mark == $grade ? "selected" : "") . ">$grade</option>";
                    ?>
                </select>
            </div>
            <button type="submit" name="updategrade" class="btn btn-outline-primary"><i class="bi bi-floppy"></i> Update data</button>
        </form>
    </div>
    <div class="col-md-6">
    <h3>Grade history</h3>
        <?php
              echo "<table class='table table-bordered text-center'>";
            echo "<thead><tr><th>Grade</th><th>Last updated by</th><th>Last updated on</th><th>Status</th></tr></thead>";
            echo "<tbody>";
                if(isset($grade_information->mark)){ 
                    echo "<tr><td>" . $grade_information->mark . "</td><td>" . $grade_information->vards . " " . $grade_information->uzvards . "</td><td>" . date("d.m.Y. H:i:s", $grade_information->last_update) . "</td><td>Current</td></tr>";
                }
                $mark = new Marks();
                $grade_history = $mark->select('mark','last_update','uzvards','vards')->join('darbinieki_user', 'marks.last_staff = darbinieki_user.id')->eq('module_code', $module_code)->eq('student_no', $student_no)->ne('deleted',0)->orderBy('last_update desc')->findAll();
              
                foreach ($grade_history as $grade_loop) {
                    echo "<tr><td>" . $grade_loop->mark . "</td><td>" . $grade_loop->vards . " " . $grade_loop->uzvards . "</td><td>" . date("d.m.Y. H:i:s", $grade_loop->last_update) . "</td><td>Deleted</td></tr>";
                }
            echo "</tbody>";
            echo "</table>";           
        ?>
    </div>
</div>

 