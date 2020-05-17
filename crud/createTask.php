<?php
    require('../datalayer.php');
    createTask($_POST);
    header("Location: ../index.php");
?>