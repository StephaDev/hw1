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
            header("Location: carrello.php");
            exit;
        }
        else 
        {
            $errore = 'Username o password errati';  
        }
    
    }


    $conn = mysqli_connect("localhost", "root", "", "account");

    $res = mysqli_query($conn, "SELECT * FROM carrello WHERE username_utente ='" . $_SESSION['username'] . "'") or die ("Errore: ".mysqli_error($conn));
    //Verifico che ci sia qualcosa nel carrello
    if (mysqli_num_rows($res) > 0) {
      while($row = mysqli_fetch_assoc($res)) {
        $prodotti[] = $row;
      }
    }

    if (mysqli_num_rows($res) <= 0) {
      $prodotti = 0;
    }

    mysqli_free_result($res);
    mysqli_close($conn);

    json_encode($prodotti);

?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>WebShop</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="carrello.css">
  <script src="carrello.js" defer="true"></script>
</head>
<body class="no-scroll">

  <div class="overlay">
  </div>
  <header>
    <div class="nav-bar">
      <div class="logo">
        <a href="#">WebShop</a>
      </div>
      <div class="menu">
        <ul>
          <li><a href="home_loggato.php">Home<i class="fa fa-home" aria-hidden="true"></i></a></li>
          <li><a href="negozio.php">Negozio<i class="fa fa-shopping-bag" aria-hidden="true"></i></a></li>
          <li><a href="#" class="active">Carrello<i class="fa fa-shopping-cart" aria-hidden="true"></i><span>.</span></a></li>
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
      <a href="negozio.php">Negozio<i class="fa fa-shopping-bag" aria-hidden="true"></i></a>
      <a href="#">Carrello<i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
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
    <form action="cambiapcarrello.php" method="POST" class="form-container">
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

  <!--CARRELLO-->
  <div class="wrapper">
		<h1>Prodotti del carrello</h1>
		<div class="project">
			<div class="shop">
        <?php 
        if ($prodotti != 0)
        foreach($prodotti as $prodotto) {
            echo '<div class="box" id="' . $prodotto["ID"]. '">
                    <img src="' . $prodotto["immagine"] . '">
                    <div class="content">
                      <h3>' . $prodotto["titolo"] . '</h3>
                      <h4>Prezzo: ' . $prodotto["prezzo"] . '€' . '</h4>
                      <p class="unit">Quantita: <input type="number" min="1" name="" value="' . $prodotto["quantita"] . '"></p>
						          <p class="btn-area"><i aria-hidden="true" class="fa fa-trash"></i> <span class="btn2">Remove</span></p>
                    </div>
                  </div>';
        }
        ?>
			</div>
			<div class="right-bar">
				<p><span>Totale degli articoli</span> <span id="totale">0</span></p>
				<hr>
				<p><span>IVA (22%)</span> <span id="tassa">0</span></p>
				<hr>
				<p><span>Costi di spedizione</span> <span id="spedizione">0</span></p>
				<hr>
				<p><span>Totale</span> <span id="ammontare">0</span></p><a href="#"><i class="fa fa-shopping-cart"></i>Checkout</a>
			</div>
		</div>
	</div>

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