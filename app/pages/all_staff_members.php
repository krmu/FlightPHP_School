<?php
$staff = new Staff();
$all_staff_members = $staff->findAll();
?>
<table class="table text-center">
    <thead>
        <tr class="table-active">
            <th>Staff ID</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Username</th>
            <th>Is admin?</th>
            <th>Is active?</th>
            <th>Is staff?</th>
            <th>Last login</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($all_staff_members as $staff_member) {
        ?>
            <tr>
                <td><?= $staff_member -> id ?></td>
                <td><?= $staff_member->vards ?></td>
                <td><?= $staff_member->uzvards ?></td>
                <td><?= $staff_member->username ?></td>
                <td><?= ($staff_member->admin == 1 ? "Yes" : "No") ?></td>
                <td><?= ($staff_member->is_active == 1 ? "Yes" : "No") ?></td>
                <td><?= ($staff_member->staff == 1 ? "Yes" : "No") ?></td>
                <td><?= date("d.m.Y. H:i:s", strtotime($staff_member->last_login)) ?></td>
                <td>
                    <a class='btn btn-primary' href="<?= Flight::create_full_url('staff_add_edit', ["staff_id" => $staff_member->id]) ?>"><i class="bi bi-pencil-square"></i> Edit</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>