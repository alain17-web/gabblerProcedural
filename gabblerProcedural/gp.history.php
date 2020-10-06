<?php 

require 'connectToDB.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archives</title>
</head>
<body>
    <h1>ARCHIVES</h1>

<!--formulaire de recherche par mot-clé-->
    <form action="gp.search.php" method="GET">
        <input type="search" name="search" id="submit-search" value="" placeholder="Type a keyword">
        <button type="submit" id="submit-search" name="submit-search">Search</button>
    </form><br/><br/>
<!------------------------------------------>
    
    <div id="filters">
        <button type="button"><a href="gp.filters.php">filters</a></button>
    </div>
<hr/>
<h2>All messages in General Room :</h2><br/><br/>
<div id="message">

<?php

//--------Requête pour obtenir tous les messages du salon général---------
$ar_sql = "SELECT * FROM `message`
JOIN `user`
ON `id_user` = `fkey_user_id`
JOIN `room`
ON `id_room` = `fkey_room_id`";

$ar_req = mysqli_query($db,$ar_sql);

//----------------------------------------------------------------------


//----------------Affichage des messages du salon général--------------------------------

while ($ar_row = mysqli_fetch_assoc($ar_req)){
    ?>
    <b><?php echo $ar_row['nickname_user'];?> : </b><?php echo $ar_row['content_message'];?><br/><?php echo $ar_row['name_room'];?> - <?php echo $ar_row['date_message'];?><br/><br/>
    <?php 
    }
//-----------------------------------------------------------------------
    ?>
    
    <!-----------jQuery à vérifier------------------------------------------------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        setInterval('load_messages()', 1500);
        function load_messages(){
            $('#message').load('load_messages.php');
        }
    </script>
<!----------------------------------------------------------------------------->
    <!--<a href="gp.goToHistory.php">Vers bouton Archives</a>-->
</body>
</html>