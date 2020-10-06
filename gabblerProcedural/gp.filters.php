<?php 

require_once 'connectToDb.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search by filters</title>
</head>
<body>
    <h1>FILTERS</h1><br/><br/>
    <h1>USERS</h1><br/>
    <?php 

    $ar_sql = "SELECT DISTINCT id_user,nickname_user,name_img FROM user,img,user_has_img WHERE user_has_img_id_img = id_img";
    $ar_req = mysqli_query($db,$ar_sql);

    while ($ar_row = mysqli_fetch_assoc($ar_req)){

        
    ?>
    
        <!--<form action="gp.history.php" method="GET">
            <div class="users">-->
                <input type="checkbox"  name="user[]"> <?php echo $ar_row['nickname_user'];?><br/><br/> 
                
            <!--</div><br/>-->
    <?php 
    }
    ?>
           

        <hr>
    <h1>ROOMS</h1><br/>
    <?php 
    $ar_sql = "SELECT id_room, name_room FROM room";
    $ar_req = mysqli_query($db,$ar_sql);

    while ($ar_row = mysqli_fetch_assoc($ar_req)){

    ?>
        
            <!--<div class="rooms">-->
                <input type="checkbox" name="room[]"> <?php echo $ar_row['name_room'];?><br/><br/> 
                
            <!--</div><br>-->
    <?php 
    }
    ?>
            <hr>
            <div id="search">
                <button type="submit">SEARCH</button>
            </div>
        </form><br/>
          
        <a href="gp.history.php">Back to Archives</a>
</body>
</html>