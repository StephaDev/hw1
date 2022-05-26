<?php
    session_start();

    if (isset($_GET["email"])) {
        //Connessione al database
        $conn = mysqli_connect("localhost", "root", "", "account");
        //Faccio l'escape per evitare problemi di SQL injection
        $email = mysqli_real_escape_string($conn, $_GET["email"]);

        $emailcheck = mysqli_query($conn, "SELECT * FROM utenti WHERE email = '".$email."'");

        if (mysqli_num_rows($emailcheck) > 0) {
            echo 'Email già in uso';
        } 
    } else {
        echo "<h1>Email non ricevuta</h1>";
    }
?>
