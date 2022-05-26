<?php

    session_start();    

    if(!isset($_SESSION["username"])) {
        header("Location: accedi.php"); 
        exit;   
    }

    // Verifica dati GET
    if(isset($_GET["img"]) && isset($_GET["titolo"]) && isset($_GET["prezzo"]) && isset($_GET["quantita"]))
    {
        // Connessione al database
        $conn = mysqli_connect("localhost", "root", "", "account");

        $img = mysqli_real_escape_string($conn, $_GET["img"]);
        $titolo = mysqli_real_escape_string($conn, $_GET["titolo"]);
        $prezzo = mysqli_real_escape_string($conn, $_GET["prezzo"]);
        $quantita = mysqli_real_escape_string($conn, $_GET["quantita"]);

        $query = "SELECT titolo, quantita from carrello where titolo = '$titolo' and username_utente ='" .$_SESSION["username"]. "'";
        $res= mysqli_query($conn, $query) or die("Errore:".mysqli_error($conn));

        $row = mysqli_fetch_assoc($res);
        $titolo_carrello = $row["titolo"];
        $quantita_carrello = $row["quantita"];
        $quantincr = $quantita_carrello + 1;

        print_r($titolo);
        print_r($titolo_carrello);

        if ($titolo_carrello == $titolo) {
            $query = "UPDATE carrello SET quantita = $quantincr WHERE titolo = '$titolo'";
            mysqli_query($conn, $query) or die("Errore:".mysqli_error($conn));  
            echo "va bene";
            exit;
        } else {
            mysqli_query($conn, "INSERT INTO carrello (username_utente, titolo, prezzo, quantita, immagine) VALUES " . "('" . $_SESSION['username'] . "', '$titolo', '$prezzo', '$quantita', '$img');") or die ("Errore: ".mysqli_error($conn));
        }
        
        // Chiudi connessione
        mysqli_close($conn);
    }
?>