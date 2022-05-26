<?php
    session_start();

    if (isset($_GET["username"])) {
        //Connessione al database
        $conn = mysqli_connect("localhost", "root", "", "account");
        //Faccio l'escape per evitare problemi di SQL injection
        $username = mysqli_real_escape_string($conn, $_GET["username"]);

        $usernamecheck = mysqli_query($conn, "SELECT * FROM utenti WHERE username = '".$username."'");

        if (mysqli_num_rows($usernamecheck) > 0) {
            echo 'Username già in uso';
        } 
    } else {
        echo "<h1>Username non ricevuto</h1>";
    }
?>