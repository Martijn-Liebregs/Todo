<?php

    require('../datalayer.php');
    if($_SERVER['REQUEST_METHOD']=='POST'){
        editListConfirm($_POST);
    }

?>

    <div class="container"> 

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?edit=<?php echo $_GET['list_id']; ?>">
            <input type="hidden" name="list_id" value="<?php echo $_GET['list_id']; ?>">
            <input type="text" name="list_name" placeholder="list name">
            <input type="submit" class="w3-button w3-teal" value="Confirm">
        </form>
        
    </div>