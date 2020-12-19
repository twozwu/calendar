<?php

  if (isset($_GET["name"]) && isset($_GET["place"])) {
      echo '歡迎'.$_GET["name"].'從'.$_GET["place"].'過來';
  }

?>
