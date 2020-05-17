<?php

    require('../datalayer.php');
    if($_SERVER['REQUEST_METHOD']=='POST'){
        editTaskConfirm($_POST);
    }

?>

    <div class="container"> 

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?edit=<?php echo $_GET['task_id']; ?>">
            <input type="hidden" name="task_id" value="<?php echo $_GET['task_id']; ?>">
            <input type="text" name="task_name" placeholder="task name">
            <input type="text" name="task_info" placeholder="task info">
            <input type="text" name="task_status" placeholder="task status">
            <input type="text" name="task_duration" placeholder="task duration">
            <input type="submit" class="w3-button w3-teal" value="Confirm">
        </form>
        
    </div>