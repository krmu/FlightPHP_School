<?php
$all_active_students = Flight::db()->fetchAll("SELECT * FROM students order by forename");
echo "<table class='table table-bordered text-center'>";
echo "<thead>";
echo "<tr>";
echo "<th>Name</th>";
echo "<th>Surname</th>";
echo "<th>Student number</th>";
echo "<th>Active</th>";
echo "<th>Actions</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
foreach ($all_active_students as $student) {
    echo "<tr>";
    echo "<td>" . $student['forename'] . "</td>";
    echo "<td>" . $student['surname'] . "</td>";
    echo "<td>" . $student['student_no'] . "</td>";
    echo "<td>" . ($student['aktivs'] == 1 ? "Yes" : "No") . "</td>";
    echo "<td><a href='" . Flight::create_full_url('students_new_edit', ["student_no" => $student['student_no']]) . "'>Edit student data</a></td>";
    echo "</tr>";
}
