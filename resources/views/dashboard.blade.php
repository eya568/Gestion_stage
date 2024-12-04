@include('components.side-bar')
<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

  <!-- Page CSS -->

  <!-- Helpers -->

  <script src="../assets/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="../assets/js/config.js"></script>
</head>

<body>
  <!-- Layout wrapper -->





  <!-- / Menu -->

  <!-- Layout container -->
  <div class="layout-page">
    <!-- Navbar -->

    <nav
      class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
      id="layout-navbar">
      <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
          <i class="bx bx-menu bx-sm"></i>
        </a>
      </div>

      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
          <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            <input
              type="text"
              class="form-control border-0 shadow-none"
              placeholder="Search..."
              aria-label="Search..." />
          </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
          <!-- Place this tag where you want the button to render. -->
          <li class="nav-item lh-1 me-3">
            <a
              class="github-button"
              href="https://github.com/themeselection/sneat-html-admin-template-free"
              data-icon="octicon-star"
              data-size="large"
              data-show-count="true"
              aria-label="Star themeselection/sneat-html-admin-template-free on GitHub">Star</a>
          </li>

          <!-- User -->
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="#">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar avatar-online">
                        <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                      <small class="text-muted">Admin</small>
                    </div>

                  </div>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                  <i class="bx bx-user me-2"></i>
                  <span class="align-middle">Mon Profile</span>
                </a>

              </li>

              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>

                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="bx bx-power-off me-2"></i>
                  <span class="align-middle">Log Out</span>
                </a>

              </li>
            </ul>
          </li>
          <!--/ User -->
        </ul>
      </div>
    </nav>

    <!-- / Navbar -->

    <!-- Content wrapper -->
    <div class="content-wrapper">
      <!-- Content -->

      <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
          <div class="col-lg-8 mb-4 order-0">
            <div class="card">
              <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                  <div class="card-body">
                    <h5 class="card-title text-primary">Congratulations John! 🎉</h5>
                    <p class="mb-4">
                      You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in
                      your profile.
                    </p>

                    <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                  </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                  <div class="card-body pb-0 px-0 px-md-4">
                    <img
                      src="../assets/img/illustrations/man-with-laptop-light.png"
                      height="140"
                      alt="View Badge User"
                      data-app-dark-img="illustrations/man-with-laptop-dark.png"
                      data-app-light-img="illustrations/man-with-laptop-light.png" />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 order-1">
            <div class="row">
              <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                        <img
                          src="../assets/img/icons/unicons/chart-success.png"
                          alt="chart success"
                          class="rounded" />
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="cardOpt3"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                          <a class="dropdown-item" href="javascript:void(0);">View More</a>
                          <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                        </div>
                      </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Profit</span>
                    <h3 class="card-title mb-2">$12,628</h3>
                    <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                        <img
                          src="../assets/img/icons/unicons/wallet-info.png"
                          alt="Credit Card"
                          class="rounded" />
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="cardOpt6"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                          <a class="dropdown-item" href="javascript:void(0);">View More</a>
                          <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                        </div>
                      </div>
                    </div>
                    <span>Sales</span>
                    <h3 class="card-title text-nowrap mb-1">$4,679</h3>
                    <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <!--/ Transactions -->
        </div>
      </div>
      <!-- / Content -->

      <!-- Footer -->

      <!-- / Footer -->

      <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
  </div>
  <!-- / Layout page -->
  </div>

  <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- / Layout wrapper -->



  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="../assets/vendor/libs/jquery/jquery.js"></script>
  <script src="../assets/vendor/libs/popper/popper.js"></script>
  <script src="../assets/vendor/js/bootstrap.js"></script>
  <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="../assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

  <!-- Main JS -->
  <script src="../assets/js/main.js"></script>

  <!-- Page JS -->
  <script src="../assets/js/dashboards-analytics.js"></script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>