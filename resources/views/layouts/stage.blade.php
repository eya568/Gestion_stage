<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Gestion des Soutenances</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<!-- Bootstrap 5 JS (with bundled Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      color: #333;
      padding-bottom: 60px;
    }

    .table-container {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .hover-effect:hover {
      background-color: #f1f1f1;
    }

    .sidebar {
      background-color: #343a40;
      color: #fff;
      height: 100vh;
      padding: 20px;
    }

    .sidebar a {
      color: #fff;
      text-decoration: none;
      display: block;
      padding: 10px;
      margin-bottom: 5px;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    .sidebar a:hover {
      background-color: #495057;
    }
  </style>
</head>
<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <div class="container-fluid">
      <div class="row">
          <!-- Sidebar -->
          <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
              @include('components.side-bar')
          </nav>

          <!-- Main content -->
          <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
              @yield('content') <!-- Where the page content will be injected -->
          </main>
      </div>
  </div>

  <!-- Include JavaScript files here -->
</body>

</html>