<?php
echo "<table class='table table-bordered text-center'>";
echo "<thead>";
echo "<tr class='table-active'>";
echo "<th>Module code</th>";
echo "<th>Module name</th>";
echo "<th>Active</th>";
echo "<th>Actions</th>";
echo "</tr>";
echo "</thead><tbody id='table_body'></tbody></table>";
?>
<script>
$(document).ready(function() {
    $.post("<?= Flight::create_full_url('api_modules_get_all_list') ?>").done(
        function(response){
            if(response.length == 0){
                Swal.fire("No students found", "No students found in the database", "info");
            }else{
                response.forEach(element => {
                    $('#table_body').append('<tr><td>' + element.module_code + '</td><td>' + element.module_name + '</td><td>' + (element.aktivs == 1 ? 'Yes' : 'No') + '</td><td><a class="btn btn-primary" href="' + element.edit_url + '"><i class="bi bi-pencil-square"></i> Edit</a></td></tr>');
                });
            }
        }
    ).fail(
        function(jqXHR, textStatus, errorThrown) {
            Swal.fire("Error!", "Error occured while fetching data from server."+"("+jqXHR.status+")", "error");
        }
    );
});
</script>
<?php 