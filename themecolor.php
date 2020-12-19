<?php
    $connection = mysqli_connect("localhost", "w200625", '!@#$asdf', "w200625_cal");
    if(!$connection){
        die("There was an error connecting to the database.");
    }
    function db_updateTheme($newTheme){
        global $connection;
        $query = "UPDATE theme SET cur_theme = '$newTheme' WHERE id = 1";
        $result = mysqli_query($connection, $query);
        if(!$result){
            die("Query failed: " . mysqli_error($connection));
          }
        }
    if(isset($_GET['color'])){

      db_updateTheme($_GET['color']);
    }
?>