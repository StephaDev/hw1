<?php   
    session_start();   
    if(!isset($_SESSION["username"])) {
      header("Location: accedi.php"); 
      exit;   
  }
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>WebShop</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="home_loggato.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
  <script src="home_loggato.js" defer="true"></script>
  <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
</head>

<body>
  <div class="hidden overlay">
  </div>
  <header>
    <div class="nav-bar">
      <div class="logo">
        <a href="#">WebShop</a>
      </div>
      <div class="menu">
        <ul>
          <li><a href="#" class="active">Home<i class="fa fa-home" aria-hidden="true"></i><span>.</span></a></li>
          <li><a href="negozio.php">Negozio<i class="fa fa-shopping-bag" aria-hidden="true"></i></a></li>
          <li><a href="carrello.php">Carrello<i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
          <li>
            <div class="dropdown">
            <?php echo '<button class="dropbtn">' . $_SESSION["username"] .'<i class="fa fa-user" aria-hidden="true"></i><i class="arrow down"></i></button>'; ?>
              <div id="myDropdown" class="dropdown-content">
                  <a id ="logout" href="logout.php">Logout</a>
                  <a class="cambiap" href="#">Cambia profilo</a>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div id="mobile-container">
        <div id="mobile-menu">
          <i class="fa fa-bars"></i>
        </div>
      </div>
    </div>
    <div id="links-mobile">
      <a href="#" class="active">Home<i class="fa fa-home" aria-hidden="true"></i></a>
      <a href="negozio.php">Negozio<i class="fa fa-shopping-bag" aria-hidden="true"></i></a>
      <a href="carrello.php">Carrello<i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
      <div class="dropdown">
            <?php echo '<button class="dropbtnm">' . $_SESSION["username"] .'<i class="fa fa-user" aria-hidden="true"></i><i class="arrow down"></i></button>'; ?>
              <div id="myDropdown2" class="dropdown-content">
                  <a id ="logout" href="logout.php">Logout</a>
                  <a class="cambiap" href="#">Cambia profilo</a>
              </div>
      </div>
    </div>
    <div class="benvenuto">
      <div class="content">
        <h2><span>Benvenuto</span><br> <?php print_r($_SESSION["username"]) ?></h2>
        <p>Che ci fai ancora qui? Visita lo SHOP e riempi quel carrello!</p>
        <button class="listino-btn">
        <a href="negozio.php">Negozio</a><span><i class="fa fa-arrow-circle-o-right"></i></span>
      </button>
      </div>
    </div>
  </header>
  <div class="login-popup" id="Login">
    <form action="cambiaphome.php" method="POST" class="form-container">
      <button type="button" class="btn cancel">X</button>
      <h1>Accedi</h1>
  
      <label for="username"><b>Nome utente</b></label>
      <input type="text" placeholder="Inserisci nome utente" name="username" required>
  
      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Inserisci password" name="psw" required>
      <p>Non sei ancora registrato?</p><a href="registration.html">Registrati adesso!</a>
  
      <button type="submit" id="invia" class="btn">Login</button>
    </form>
  </div>
  <!--SWIPER-->
  <h1 id="presentation">Per aiutarti con gli acquisti, ti presentiamo alcune delle nostre migliori categorie</h1>
  <section class="swiper" id="abbigliamento">

    <h1 class="heading">ABBIGLIAMENTO</h1>

    <div class="swiper vehicles-slider">

        <div class="swiper-wrapper">

        </div>

        <div class="swiper-pagination"></div>

    </div>

  </section>

  <section class="swiper" id="tecnologia">

  <h1 class="heading">TECNOLOGIA</h1>

  <div class="swiper vehicles-slider">

      <div class="swiper-wrapper">

      </div>

      <div class="swiper-pagination"></div>

  </div>

  </section>

  <section class="swiper" id="estetica">

  <h1 class="heading">ESTETICA</h1>

  <div class="swiper vehicles-slider">

    <div class="swiper-wrapper">

    </div>

    <div class="swiper-pagination"></div>

</div>

</section>

  <footer>
    <div class="testo-footer">
      <p>STEFANO SANNINO 1000002144 HW1</p>
    </div>
    <div class="social-media">
      <ul>
        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
      </ul>
    </div>
  </footer>

</script>
</body>
</html>