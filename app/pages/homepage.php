<section class="py-3 py-md-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10 col-xl-8 col-xxl-7">
        <div class="row gy-4">
          <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <?php
                    $student_count = Flight::db()->fetchField("SELECT COUNT(*) FROM students");
                    $modules_count = Flight::db()->fetchField("SELECT COUNT(*) FROM modules");
                    $marks_count = Flight::db()->fetchField("SELECT COUNT(*) FROM marks");
                    $staff_count = Flight::db()->fetchField("SELECT COUNT(*) FROM darbinieki_user");
                    ?>
                    <h5 class="card-title widget-card-title mb-3">Students</h5>
                    <h4 class="card-subtitle text-body-secondary m-0"><?= $student_count ?></h4>
                  </div>
                  <div class="col-4">
                    <div class="d-flex justify-content-end">
                      <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center">
                        <i class="bi bi-people-fill fs-4"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">Modules</h5>
                    <h4 class="card-subtitle text-body-secondary m-0"><?= $modules_count ?></h4>
                  </div>
                  <div class="col-4">
                    <div class="d-flex justify-content-end">
                      <div class="lh-1 text-white bg-warning rounded-circle p-3 d-flex align-items-center justify-content-center">
                        <i class="bi bi-book-fill fs-4"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">Marks</h5>
                    <h4 class="card-subtitle text-body-secondary m-0"><?= $marks_count ?></h4>
                  </div>
                  <div class="col-4">
                    <div class="d-flex justify-content-end">
                      <div class="lh-1 text-white bg-secondary rounded-circle p-3 d-flex align-items-center justify-content-center">
                        <i class="bi bi-9-square-fill fs-4"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6">
            <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3">Staff members</h5>
                    <h4 class="card-subtitle text-body-secondary m-0"><?= $staff_count ?></h4>
                  </div>
                  <div class="col-4">
                    <div class="d-flex justify-content-end">
                      <div class="lh-1 text-white bg-danger rounded-circle p-3 d-flex align-items-center justify-content-center">
                        <i class="bi bi-shield-fill fs-4"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>