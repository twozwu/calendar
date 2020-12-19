<?php
    $connection = mysqli_connect("sql203.byethost5.com", "b5_26260316", "37213824", "b5_26260316_calender");
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
    //測試修改資料庫要用get，如果用post會無法即時顯示(因為post的index.php是未來的php)
?>