<?php
    session_start();

    $usrerror = "";
    $mailerror = "";
    $cpassword = "";
    $ok = "";

    //Verifica l'esistenza di dati provenienti dalla richiesta POST (ci saranno sempre poiche ho messo required nell'<input>, quindi la verifica lato client, ma faccio lo stesso la verifica anche lato server)
    if (isset($_GET["username"]) && isset($_GET["email"]) && isset($_GET["psw"]) && isset($_GET["cpsw"])) {
        //Connessione al database
        $conn = mysqli_connect("localhost", "root", "", "account");
        //Faccio l'escape di cio' che ricevo dal form per evitare problemi di SQL injection
        $username = mysqli_real_escape_string($conn, $_GET["username"]);
        $email = mysqli_real_escape_string($conn, $_GET["email"]);
        $password = mysqli_real_escape_string($conn, $_GET["psw"]);
        $cpassword = mysqli_real_escape_string($conn, $_GET["cpsw"]);

        $usernamecheck = mysqli_query($conn, "SELECT * FROM utenti WHERE username = '".$username."'");
        $emailcheck = mysqli_query($conn, "SELECT * FROM utenti WHERE email = '".$email."'");

        if (mysqli_num_rows($usernamecheck) > 0) {
            $usrerror = 'Username già in uso';
        } else if (mysqli_num_rows($emailcheck) > 0) {
            $mailerror = 'Email già in uso';
        } else if ($password != $cpassword) {
            $cpassword = 'La conferma della password non corrisponde';
            } else {
                $passmd5 = md5($password); 
                $query = "INSERT INTO utenti (username, email, password) VALUES ('$username', '$email', '$passmd5');";
                $res = mysqli_query($conn, $query) or die ("Errore: ".mysqli_error($conn));

                if ($res) {
                    $ok = 1;
                }
                else {
                    $ok = 0;
                }
            }
    } else {
        echo "<h1>Devi compilare tutti i campi</h1>";
    }

    $errori[0] = $usrerror;
    $errori[1] = $mailerror;
    $errori[2] = $cpassword;
    $errori[3] = $ok;

    print_r(json_encode($errori));

    
?>