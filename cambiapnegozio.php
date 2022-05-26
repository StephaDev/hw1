<?php
    session_start();

    //Verifica l'esistenza di dati provenienti dalla richiesta POST (ci saranno sempre poiche ho messo required nell'<input>, quindi la verifica lato client, ma faccio lo stesso la verifica anche lato server)
    if (isset($_POST["username"]) && isset ($_POST["psw"]))
    {
        //Connessione al database
        $conn = mysqli_connect("localhost", "root", "", "account");
        //Faccio l'escape di cio' che ricevo dal form per evitare problemi di SQL injection
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = mysqli_real_escape_string($conn, $_POST["psw"]);
        $passmd5 = md5($password);
        //Cerca utente con quelle credenziali
        $query = "SELECT * FROM utenti WHERE username = '".$username."' AND password = '".$passmd5."'";
        $res = mysqli_query($conn, $query) or die ("Errore: ".mysqli_error($conn));
        //Verifico se sono riuscito ad accedere (quindi se le credenziali corrette)
        if (mysqli_num_rows($res) > 0) {
            //Imposto la variabile di sessione
            $_SESSION["username"] = $_POST["username"];
            // Torno alla pagina una volta loggato
            header("Location: negozio.php");
            exit;
        }
        else 
        {
            $errore = 'Username o password errati';  
        }
    
    }
?>


<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Sannino's Auto</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
  <link rel="stylesheet" type="text/css" href="negozio.css">
  <script src="negozio.js" defer="true"></script>
  <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
</head>

<body class="no-scroll">
  <div class="overlay"></div>
  <!--HEADER (CONTENTENTE NAVBAR)-->
  <header>
    <div class="nav-bar">
      <div class="logo">
        <a href="#">WebShop</a>
      </div>
      <div class="menu">
        <ul>
          <li><a href="home_loggato.php">Home<i class="fa fa-home" aria-hidden="true"></i></a></li>
          <li><a href="#" class="active">Negozio<i class="fa fa-shopping-bag" aria-hidden="true"></i><span>.</span></a></li>
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
      <a href="home_loggato.php" class="active">Home<i class="fa fa-home" aria-hidden="true"></i></a>
      <a href="#">Negozio<i class="fa fa-shopping-bag" aria-hidden="true"></i></a>
      <a href="carrello.php">Carrello<i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
      <div class="dropdown">
            <?php echo '<button class="dropbtnm">' . $_SESSION["username"] .'<i class="fa fa-user" aria-hidden="true"></i><i class="arrow down"></i></button>'; ?>
              <div id="myDropdown2" class="dropdown-content">
                  <a id ="logout" href="logout.php">Logout</a>
                  <a class="cambiap" href="#">Cambia profilo</a>
              </div>
      </div>
    </div>
  </header>
  <!--LOGIN-->
  <div class="login-popup" id="Login" style="display:block">
    <form action="cambiapnegozio.php" method="POST" class="form-container">
      <button type="button" class="btn cancel">X</button>
      <h1>Accedi</h1>
  
      <label for="username"><b>Nome utente</b></label>
      <input type="text" placeholder="Inserisci nome utente" name="username" required>
  
      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Inserisci password" name="psw" required>
      <?php
        echo "<p id='err' style='color:red; display:block; margin-bottom:2vh'>$errore</p>";
      ?>
      <p>Non sei ancora registrato?</p><a href="registration.html">Registrati adesso!</a>
  
      <button type="submit" id="invia" class="btn">Login</button>
    </form>
  </div>
  <!--RICERCA-->
  <div class="ricerca">
    <form action="" id="cerca" autocomplete="off">
    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
      width="30" height="30"
      viewBox="0 0 172 172"
      style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M74.53333,17.2c-31.59642,0 -57.33333,25.73692 -57.33333,57.33333c0,31.59642 25.73692,57.33333 57.33333,57.33333c13.73998,0 26.35834,-4.87915 36.24766,-12.97839l34.23203,34.23203c1.43802,1.49778 3.5734,2.10113 5.5826,1.57735c2.0092,-0.52378 3.57826,-2.09284 4.10204,-4.10204c0.52378,-2.0092 -0.07957,-4.14458 -1.57735,-5.5826l-34.23203,-34.23203c8.09924,-9.88932 12.97839,-22.50768 12.97839,-36.24766c0,-31.59642 -25.73692,-57.33333 -57.33333,-57.33333zM74.53333,28.66667c25.39937,0 45.86667,20.4673 45.86667,45.86667c0,25.39937 -20.46729,45.86667 -45.86667,45.86667c-25.39937,0 -45.86667,-20.46729 -45.86667,-45.86667c0,-25.39937 20.4673,-45.86667 45.86667,-45.86667z"></path></g></g></svg>
    
    <label><input name="cerca" type="text" placeholder="Cerca nello shop"></label>
    </form>
  </div>
  <!--NEGOZIO-->
  <section class="negozio-popup">
      
  </section>
  <!--FOOTER-->
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

</body>
</html>