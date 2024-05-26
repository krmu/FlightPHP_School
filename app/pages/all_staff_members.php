<?php
$all_staff_members = Flight::db()->fetchAll("SELECT * FROM darbinieki_user");
?>
<table class="table table-striped text-center">
    <thead>
        <tr>
            <th>Staff ID</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Username</th>
            <th>Is admin?</th>
            <th>Is active?</th>
            <th>Is staff?</th>
            <th>Last login</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($all_staff_members as $staff_member) {
        ?>
            <tr>
                <td><?= $staff_member['id'] ?></td>
                <td><?= $staff_member['vards'] ?></td>
                <td><?= $staff_member['uzvards'] ?></td>
                <td><?= $staff_member['username'] ?></td>
                <td><?= ($staff_member['admin'] == 1 ? "Yes" : "No") ?></td>
                <td><?= ($staff_member['is_active'] == 1 ? "Yes" : "No") ?></td>
                <td><?= ($staff_member['staff'] == 1 ? "Yes" : "No") ?></td>
                <td><?= date("d.m.Y. H:i:s", strtotime($staff_member['last_login'])) ?></td>
                <td>
                    <a href="<?= Flight::create_full_url('staff_add_edit', ["staff_id" => $staff_member['id']]) ?>">Edit</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>