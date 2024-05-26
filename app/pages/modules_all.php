<?php

$all_modules = Flight::db()->fetchAll("SELECT * FROM modules");
echo "<table class='table table-bordered text-center'>";
echo "<thead>";
echo "<tr>";
echo "<th>Module code</th>";
echo "<th>Module name</th>";
echo "<th>Active</th>";
echo "<th>Actions</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
foreach ($all_modules as $module) {
    echo "<tr>";
    echo "<td>" . $module['module_code'] . "</td>";
    echo "<td>" . $module['module_name'] . "</td>";
    echo "<td>" . ($module['aktivs'] == 1 ? "Yes" : "No") . "</td>";
    echo "<td><a href='" . Flight::create_full_url('modules_new_edit', ['module_code' => $module['module_code']]) . "'>Edit</a></td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
