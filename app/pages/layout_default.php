<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?= Flight::get('main_url') ?>/assets/css/bootstrap.min.css">
    <script src="<?= Flight::get('main_url') ?>/assets/js/jq.js"></script>
    <script src="<?= Flight::get('main_url') ?>/assets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>FlightPHP School :: <?= $title ?></title>
    <script>
        <?php if (isset($_SESSION['csrf-token'])) { ?>  
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '<?=$_SESSION['csrf-token']?>'
                }
            }); 
        <?php } ?>
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">FligtPHP Uni</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php
            if (isset($_SESSION['USER_ID'])) {
            ?>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href='<?= Flight::create_full_url('home') ?>'> <i class="bi bi-house-door"></i> Homepage</a>
                        </li>
                        <?php
                        if (Flight::get_user_data('admin') || Flight::get_user_data('staff')) {
                        ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-people"></i> Students and grades
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href='<?= Flight::create_full_url('students_grades_overview') ?>'>All students and grades</a></li>
                                    <li><a class="dropdown-item" href='<?= Flight::create_full_url('students_view_all') ?>'>All students</a></li>
                                    <li><a class="dropdown-item" href='<?= Flight::create_full_url('students_new_edit') ?>'>New student</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-journal-check"></i> Modules
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href='<?= Flight::create_full_url('modules_all') ?>'>All modules</a></li>
                                    <li><a class="dropdown-item" href='<?= Flight::create_full_url('modules_new_edit') ?>'>New module</a></li>
                                </ul>
                            </li>
                        <?php
                        }
                        if (Flight::get_user_data('admin')) {
                        ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-gear"></i> Staff members
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li class="nav-item">
                                        <a class="dropdown-item" aria-current="page" href='<?= Flight::create_full_url('all_staff_members') ?>'>All staff members</a>
                                    </li>
                                    <li><a class="dropdown-item" href='<?= Flight::create_full_url('staff_add_edit') ?>'>New staff member</a></li>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                    <span class="navbar-text">
                        Hello, <?= Flight::get_user_data('vards') . " " . Flight::get_user_data('uzvards') ?> <a href='<?= Flight::create_full_url('logout') ?>'>Logout</a>
                    </span>
                </div>
        </div>
    <?php
            }
    ?>
    </nav>
    <div class="container pt-4">
        <h3 class="mb-4"><i class="bi bi-dot"></i> <?= $title ?></h3>
        
        <?= $saturs ?>
    </div>
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">© <?=date("Y") ?> <a href="https://github.com/krmu/FlightPHP_School">FlightPHP School</a>, Kristaps Muižnieks</span>
        </div>
    </footer>
</body>

</html>