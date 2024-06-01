<?php

$modules = new Modules();
$all_modules = $modules->findAll();
echo "<table class='table table-bordered text-center'>";
echo "<thead>";
echo "<tr class='table-active'>";
echo "<th>Module code</th>";
echo "<th>Module name</th>";
echo "<th>Active</th>";
echo "<th>Actions</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
foreach ($all_modules as $module) {
    echo "<tr>";
    echo "<td>" . $module -> module_code . "</td>";
    echo "<td>" . $module -> module_name . "</td>";
    echo "<td>" . ($module->aktivs == 1 ? "Yes" : "No") . "</td>";
    echo "<td><a class='btn btn-primary' href='" . Flight::create_full_url('modules_new_edit', ['module_code' => $module->module_code]) . "'><i class='bi bi-pencil-square'></i> Edit</a></td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
