<?php

    session_start();    

    if(!isset($_SESSION["username"])) {
        header("Location: accedi.php"); 
        exit;   
    }

    if(isset($_GET["id"])) {

        $conn = mysqli_connect("localhost", "root", "", "account");

        mysqli_query($conn, "DELETE FROM `carrello` WHERE username_utente = '" . $_SESSION['username']. "' AND ID = '" . $_GET["id"] . "'") or die ("Errore: ".mysqli_error($conn));

        mysqli_close($conn);
    }
?>