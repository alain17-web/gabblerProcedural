<?php 

require 'connectToDB.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>span.surlign1{font-style:italic;background-color:yellow;}</style>
    <title>Search by keyword</title>
</head>
<body>
    <h1>SEARCH BY KEYWORD</h1>

    <?php 
    //-------Traitement du mot-clé reçu via le formulaire sur history.php----------
            if(isset($_GET['submit-search'])){
                $ar_search = mysqli_real_escape_string($db,$_GET['search']);
                
    //-----------------------------------------------------------------------------


    //----------Requête SQL pour trouver tous les mots ressemblant au mot-clé entré dans le champ Search-------------------------------
                $ar_sql = /*"SELECT * FROM message,user,room WHERE content_message LIKE '%$ar_search%' OR nickname_user LIKE '%$ar_search%' OR date_message LIKE '%$ar_search%' OR name_room LIKE '%$ar_search%' ORDER BY date_message ASC";*/

                "SELECT * FROM message
                INNER JOIN user
                ON id_user = fkey_user_id
                INNER JOIN room
                ON id_room = fkey_room_id
                WHERE content_message LIKE '%$ar_search%' OR nickname_user LIKE '%$ar_search%' OR date_message LIKE '%$ar_search%' OR name_room LIKE '%$ar_search%' 
                ORDER BY date_message ASC";

                $ar_result = mysqli_query($db,$ar_sql);
                
    //-----------------------------------------------------------------------------------------------------------------------------


                //-------------------Déclaration de la fonction qui colorera les mots résultats de la recherche----------------------
                function highlightWords($ar_text, $ar_search){
                    $ar_text = preg_replace('#'. preg_quote($ar_search) .'#i', '<span style="background-color: #F9F902;">\\0</span>', $ar_text);
                    return $ar_text;
                    
                }
                //--------------------------------------------------------------------------------------------------------------


                //-----------------Affichage du nombre de résultats trouvés---------------------
                $ar_queryResult = mysqli_num_rows($ar_result);
                
                ?>
                <b><?php echo "$ar_queryResult  results found";?> : </b><br/><br/>
                <?php 
                
                //------------------------------------------------------------------------------


                //---------------------Affichage en couleur des résultats------------------------- 
                if($ar_queryResult > 0){
                while($ar_row = mysqli_fetch_assoc($ar_result)){
                $ar_user = !empty($ar_search)?highlightWords($ar_row['nickname_user'],$ar_search):"";
                $ar_message = !empty($ar_search)?highlightWords($ar_row['content_message'],$ar_search):"";
                $ar_date = !empty($ar_search)?highlightWords($ar_row['date_message'],$ar_search):$ar_row['date_message'];
                $ar_room = !empty($ar_search)?
                highlightWords($ar_row['name_room'],$ar_search)
                :$ar_row['name_room'];
                

                ?>
                <b><?php echo $ar_user;?> : </b><?php echo $ar_message;?><br/><?php echo $ar_room;?> - <?php echo $ar_date;?><br/><br/>
                <?php
                }
                //----------------------------------------------------------------------------------

                //---------Affichage d'un message d'erreur si aucun résultat n'est trouvé---------
            }
            else{
                echo "There are no results matching your search";
            }
        }
                //-----------------------------------------------------------------------------------
    ?>
    <a href="gp.history.php">Back to Archives</a>
</body>
</html>