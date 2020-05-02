<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>ParkinMeter</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">

  <link rel="icon" type="image/x-icon" href="favicon.ico">

  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/bootstrap4-pleasant.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

  <!-- leafletjs -->
  <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
  <script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-omnivore/0.3.4/leaflet-omnivore.min.js"></script>
  <script src="/js/leaflet-0.7.2/leaflet.ajax.min.js"></script>

</head>

<body>
  <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

  <!-- NAVBAR----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

  <div class="container">

    <nav class="navbar fixed-top navbar-expand-md bg-dark navbar-dark ">

      <a class="navbar-brand" href="#"><i class="fas fa-parking"></i> /ParkinMeter</a>

      <!-- Toggler/collapsibe Button -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar links -->
      <div class="collapse navbar-collapse " id="collapsibleNavbar">
      </div>
      <div class="collapse navbar-collapse justify-content-end " id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item ">
            <a class="nav-link " href="login.php"> Admin Login</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>




  <section class="container">

    <!-- Map----------------------------------------------------------------------------------------------------------------------------->

    <div class="left-half">
      <div id="map">
        <script src="js/map.js"></script>
      </div>
    </div>

    <!--RightHalfContent----------------------------------------------------------------------------------------------------------------------------->

    <div class="right-half">
      <div class="jumbotron-fluid text-center ">
        <div class="container">
          <br>

          <h1>ParkinMeter | Smart Parking System</h1>
          <br>


          <p>Καλοσωρήσατε στο ParkinMeter,ένα πλήρες σύστημα προσομοίωσης διαχείρισης
            της παρόδιας στάθμευσης. </p>

          <br>

          <p>To ParkinMeter προσφέρει την δυνατότητα προσομοίωσης για την διαχείριση της παρόδιας στάθμευσης.
            Διαλέγοντας την ώρα που θέλετε το σύστημα επεξεργάζει μέσω ευφυών αισθητήρων διαφόρα πολύγωνα της ρυμοτομίας μιας πόλης όπου μετέπειτα θα εμφανιστούν οι διαθέσιμες σταθμεύσεις.
            <br>
            <br>
            Πατώντας το κουμπί ποιο κάτω θα μπόρειται να τρέξεται την εξομοίωση απο μόνοι σας.
            Το Demo μας προσφέρει την δυνατότητα εξομοίωσης για την <b>Θεσσαλονίκη</b> και στο μέλλον αναμένονται να προστεθούν κίαλλες!

          </p>

          <br>

          <a class="btn btn-dark" href="guest.php" role="button">Πάτησε εδώ!</a>

        </div>
      </div>
    </div>


  </section>
  <!--Container-->


  <script src="js/main.js"></script>
  <script src="js/vendor/modernizr-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')
  </script>
  <script src="js/plugins.js"></script>

</body>

</html>