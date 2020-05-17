<?php
    require('../datalayer.php');
    createList($_POST);
    header("Location: ../index.php");
?>