<?php

  session_start();

  require ('steamauthOOP.class.php');  
  $steam = new steamauthOOP();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyTickets - ServerName</title>
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/myTicket.css">
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
    <div style="width: 35%; margin: auto; margin-top: 150px; margin-bottom: 150px;">
		<h1>MyTickets</h1>
    
        <hr>
            <?php

                if(!$steam->loggedIn()) {
                    header('location: index.php');
                } else {
                
                    echo '<p style="float: right;"><a href="index.php">Home</a></p>';

                    $identifier = $_SESSION["identifier"];

                    if (strcasecmp($identifier, "steam:1100001161CAFCB") == 0 || strcasecmp($identifier, "steam:76561198253441998" == 0) || strcasecmp($identifier, "steam:76561198874327219")) {

                        echo '<p style="font-weight: bold;">Sei un Admin</p>';

                        if(isset($_GET['resultInsert'])) {

                            if($_GET['resultInsert'] == "OK") {
                                echo '<p id="ticketOK">Ticket Inviato!</p>';
                            } else {
                                echo 'Errore: Ticket non inviato';
                            }
                            
                        }
        
                        $con = mysqli_connect('127.0.0.1', 'root', '', 'ticket');
                        
                        $sql = "SELECT id, date, identifier, name, title, content FROM users";
                        $result = $con->query($sql);
        
                        function deleteTicket() {
                            $con = mysqli_connect('127.0.0.1', 'root', '', 'ticket');
                    
                            if (mysqli_connect_errno()) {
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            }
                    
                            $id = $_GET['id'];
                    
                            mysqli_query($con, "DELETE FROM users WHERE id='".$id."'");
                            mysqli_close($con);
                        }
                    
        
                        if ($result->num_rows > 0) {
                            
                            while($row = $result->fetch_assoc()) {
                            
                                echo '
                                    <div id="tickRectangle'.$row['id'].'" class="rectangle">
                                        <div class="rectangle-text">
                                            <span>⚠️ Ticket n.'.$row["id"] . " di " . $row["name"] . " del " . $row["date"] . "</span>
                                            <br>
                                            <span style = 'font-weight: bold;'>" . $row["title"]. "</span>
                                            <br>
                                            <span>" . $row["content"]. "</span>
                                            <br>".'
                                            <td><a style="cursor: pointer; text-decoration: underline;" onclick="loadDoc('.$row["id"].');">Delete</a></td>
                                        </div>
                                    </div>
                                ';
                            }
                        }
        
                        if (isset($_GET['delete'])) {
                            deleteTicket();
                        }

                    } else {

                        if(isset($_GET['resultInsert'])) {

                            if($_GET['resultInsert'] == "OK") {
                                echo '<p id="ticketOK">Ticket Inviato!</p>';
                            } else {
                                echo 'Errore: Ticket non inviato';
                            }
                            
                        }

                        $con = mysqli_connect('127.0.0.1', 'root', '', 'ticket');

                        $identifier = $_SESSION["identifier"];
                        
                        $sql = "SELECT id, date, identifier, name, title, content FROM users WHERE identifier = '$identifier'";
                        $result = $con->query($sql);

                        function deleteTicket() {
                            $con = mysqli_connect('127.0.0.1', 'root', '', 'ticket');
                    
                            if (mysqli_connect_errno()) {
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            }
                    
                            $id = $_GET['id'];
                    
                            mysqli_query($con, "DELETE FROM users WHERE id='".$id."'");
                            mysqli_close($con);
                        }
                    

                        if ($result->num_rows > 0) {
                            
                            while($row = $result->fetch_assoc()) {
                            
                                echo '
                                    <div id="tickRectangle'.$row['id'].'" class="rectangle">
                                        <div class="rectangle-text">
                                            <span>⚠️ Ticket n.'.$row["id"] . " del " . $row["date"] . "</span>
                                            <br>
                                            <span style = 'font-weight: bold;'>" . $row["title"]. "</span>
                                            <br>
                                            <span>" . $row["content"]. "</span>
                                            <br>".'
                                            <td><a style="cursor: pointer; text-decoration: underline;" onclick="loadDoc('.$row["id"].');">Delete</a></td>
                                        </div>
                                    </div>
                                ';
                            }
                        }

                        if (isset($_GET['delete'])) {
                            deleteTicket();
                        }
                    }
                }
            ?>
        <hr>

        <script>
            var time = new Date().getTime();
            $(document.body).bind("mousemove keypress", function(e) {
                time = new Date().getTime();
            });

            refresh();

            setTimeout(refresh, 10000);
        </script>
    
        <div style="text-align: right; font-size: 12px;"><i>Made By: <a href="https://github.com/Klay4" target="_blank">Klay4#2890 </a></i></div>
    </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</body>

</html>
