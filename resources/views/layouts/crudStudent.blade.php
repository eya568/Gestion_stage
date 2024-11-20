<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    

    <title>@yield('title')</title>
    @vite(['resources/css/app.css'])
  </head>
  <body>
      @yield('content') <!-- This section will be replaced by the specific page content -->

    

    <!-- Modals -->
    @yield('modals')
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


<!-- Optional: Popper.js (required for tooltips and popovers in Bootstrap 4) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


<!-- Optional: Include Popper.js if using Bootstrap tooltips or popovers -->
    @yield('custom-js')
  </body>
</html>
