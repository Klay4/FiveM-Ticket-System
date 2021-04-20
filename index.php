<?php

  session_start();

  require ('steamauthOOP.class.php');  
  $steam = new steamauthOOP();
  if (isset($_GET["logout"])) {
    $steam->logout();
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ticket - ServerName</title>
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="scripts/ticket.js"></script>

    <style>
        .table {
            table-layout: fixed;
            word-wrap: break-word;
        }
    </style>

  </head>

  <body style="background-color: #202124; color: white;">
    <div style="width: 35%; margin: auto; margin-top: 150px;">
      <h1>Ticket - FutureServer RP</h1>
      
      <hr>
        <?php
          if(!$steam->loggedIn()) {
            echo "<div style='margin: 30px auto; text-align: center;'>Benvenuto! <a href='";
            echo $steam->loginUrl();
            echo "'>Perfavore effettua il login!</a></div>";
          } else {
        
            $_SESSION["identifier"] = 'steam:'.dechex($steam->steamid);
            $_SESSION["name"] = $steam->personaname;

            $name = $_SESSION["name"];

            echo 
            '
              <p style="float: left;">Benvenuto ' . $name . '</p>
              <p style="text-align: right;"><a href="index.php?logout">Log out</a></p>

              <button id="openTicket" type="button" class="btn btn-warning" onclick="openTicket()">Apri un Ticket</button><br><br>
              <button type="button" class="btn btn-light" onclick="openMyTicket()">My Ticket</button>


              <form id="submitTicket" style="display: none; text-align: center;" action="" onsubmit="insertDoc(document)" method="post">
                <label>Titolo:</label>
                <br/>
                <input type="text" id="title" required>
                <br/>
                <label>Contenuto:</label>
                <br/>
                <textarea type="text" id="content" cols="22" rows="3" required></textarea>
                <br/>
                <input type="hidden" name="action" value="insert">

              <input class="btn btn-success" style="margin-top: 10px;" type="submit" value="Invia">
                <input class="btn btn-danger" style="margin-top: 10px;" type="button" value="Annulla" onclick="closeTicketForm()">
              </form>
            ';

          }
        ?>
      <hr>
    
      <div style="text-align: right; font-size: 12px;"><i>Made By: <a href="https://github.com/Klay4" target="_blank">Klay4#2890 </a></i></div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  </body>

</html>
