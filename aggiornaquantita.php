<?php
    session_start();    

    if(!isset($_SESSION["username"])) {
        header("Location: accedi.php"); 
        exit;   
    }

    // Verifica dati GET
    if(isset($_GET["quantita"]) && isset ($_GET["id"])) {

        // Connessione al database
        $conn = mysqli_connect("localhost", "root", "", "account") or die ("Errore:".mysqli_connect_error());

        $newquantita = mysqli_real_escape_string($conn, $_GET["quantita"]);
        $id = mysqli_real_escape_string($conn, $_GET["id"]);

        $query = "UPDATE carrello SET quantita = $newquantita WHERE id = $id AND username_utente = '" .$_SESSION["username"]. "'";
        $res = mysqli_query($conn, $query) or die("Errore:".mysqli_error($conn));

        mysqli_close($conn);
    }
    
    echo "0";
?>