<!DOCTYPE html>
<html lang="en">
<!-- test -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List Boi</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>


<body>
    <!-- Here I include the navigation -->
    <?php include("includes/navigation.php"); ?>
    <!-- Here I include the datalayer, and than I can start the readLists and readTasks functions -->
    <?php include "datalayer.php";
        $all_Lists = readLists();
        $all_Tasks = readTasks();
    ?>

    <div class="header">
        <h2>To-Do lijst, zodat je niets vergeet :O</h2>
    </div>

    <div class="container" style="width: 15835px !important"> 
        <form method="POST" action="crud/createList.php">
            <input type="text" name="list_name" placeholder="list name">
            <input type="submit" class="w3-button w3-teal" value="+">
        </form>
    </div>

    <table>
            <!-- Here I make a foreach so it loops through al the lists and shows them on your screen -->
            <?php foreach ($all_Lists as $list) { ?>
                <tr class="trTop">
                    <th>List: <?php echo $list['list_name']; ?></th>
                    <th></th>
                    <th></th>
                    <th class="ud">
                        <a class="delete" href="crud/deleteList.php?delete=<?php echo $list['list_id']; ?>">Delete</a>
                        <a class="edit" href="crud/editList.php?list_id=<?php echo $list['list_id']; ?>">Edit</a>
                        <a class="addInput" id="action_<?php echo $list['list_id'];?>" href="#add_task">Add</a>
                    </th>
                </tr>
                <tr>
                    <td>
                        <form action="crud/createTask.php" method="POST">
    
                            <input type="hidden" name="action" value="add_task">
                            <input type="hidden" name="status" value="Ongoing">
                            <input type="hidden" name="list_id" value="<?php echo $list['list_id'];?>">
                            <input type="hidden" name="task_count" value="0" id="task_counter<?php echo $list['list_id'];?>">
                            <div>
                                <div id='add_task_name<?php echo $list['list_id'];?>'></div>
                                <div id='add_status<?php echo $list['list_id'];?>'></div>
                                <div id='add_task_info<?php echo $list['list_id'];?>'></div>
                                <div id='add_task_duration<?php echo $list['list_id'];?>'></div>
                            </div>
                            <div>
                                <div>
                                    <div id='add_task<?php echo $list['list_id'];?>'></div>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>

                <!-- Here I make a foreach in another foreach so for every list the tasks will be shown to your screen -->
                <?php foreach ($all_Tasks as $task) { ?>
                    <?php if($task['task_list_id'] == $list['list_id'] ) {?>
                        <tr class="tr">
                            <td>Task: <?php echo $task['task_name']; ?></td>
                            <td>Info: <?php echo $task['task_info']; ?></td>
                            <td>Status: <?php echo $task['task_status']; ?></td>
                            <td>Duration: <?php echo $task['task_duration']; ?></td>
                        <!-- Here are the delete and edit buttons and they activate the delete and edit function -->
                            <td class="ud">
                                <a class="delete" href="crud/deleteTask.php?delete=<?php echo $task['task_id']; ?>">X</a>
                                <a class="edit" href="crud/editTask.php?task_id=<?php echo $task['task_id']; ?>"><img class="icon_edit" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA0NjkuMzM2IDQ2OS4zMzYiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQ2OS4zMzYgNDY5LjMzNjsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxnPgoJPGc+CgkJPHBhdGggZD0iTTQ1Ni44MzYsNzYuMTY4bC02NC02NC4wNTRjLTE2LjEyNS0xNi4xMzktNDQuMTc3LTE2LjE3LTYwLjM2NSwwLjAzMUw0NS43NjMsMzAxLjY4MiAgICBjLTEuMjcxLDEuMjgyLTIuMTg4LDIuODU3LTIuNjg4LDQuNTg3TDAuNDA5LDQ1NS43M2MtMS4wNjMsMy43MjItMC4wMjEsNy43MzYsMi43MTksMTAuNDc4YzIuMDMxLDIuMDMzLDQuNzUsMy4xMjgsNy41NDIsMy4xMjggICAgYzAuOTc5LDAsMS45NjktMC4xMzYsMi45MjctMC40MDdsMTQ5LjMzMy00Mi43MDNjMS43MjktMC41LDMuMzAyLTEuNDE4LDQuNTgzLTIuNjlsMjg5LjMyMy0yODYuOTgzICAgIGM4LjA2My04LjA2OSwxMi41LTE4Ljc4NywxMi41LTMwLjE5MlM0NjQuODk5LDg0LjIzNyw0NTYuODM2LDc2LjE2OHogTTI4NS45ODksODkuNzM3bDM5LjI2NCwzOS4yNjRMMTIwLjI1NywzMzMuOTk4ICAgIGwtMTQuNzEyLTI5LjQzNGMtMS44MTMtMy42MTUtNS41LTUuODk2LTkuNTQyLTUuODk2SDc4LjkyMUwyODUuOTg5LDg5LjczN3ogTTI2LjIwMSw0NDMuMTM3TDQwLjA5NSwzOTQuNWwzNC43NDIsMzQuNzQyICAgIEwyNi4yMDEsNDQzLjEzN3ogTTE0OS4zMzYsNDA3Ljk2bC01MS4wMzUsMTQuNTc5bC01MS41MDMtNTEuNTAzbDE0LjU3OS01MS4wMzVoMjguMDMxbDE4LjM4NSwzNi43NzEgICAgYzEuMDMxLDIuMDYzLDIuNzA4LDMuNzQsNC43NzEsNC43NzFsMzYuNzcxLDE4LjM4NVY0MDcuOTZ6IE0xNzAuNjcsMzkwLjQxN3YtMTcuMDgyYzAtNC4wNDItMi4yODEtNy43MjktNS44OTYtOS41NDIgICAgbC0yOS40MzQtMTQuNzEybDIwNC45OTYtMjA0Ljk5NmwzOS4yNjQsMzkuMjY0TDE3MC42NywzOTAuNDE3eiBNNDQxLjc4NCwxMjEuNzJsLTQ3LjAzMyw0Ni42MTNsLTkzLjc0Ny05My43NDdsNDYuNTgyLTQ3LjAwMSAgICBjOC4wNjMtOC4wNjMsMjIuMTA0LTguMDYzLDMwLjE2NywwbDY0LDY0YzQuMDMxLDQuMDMxLDYuMjUsOS4zODUsNi4yNSwxNS4wODNTNDQ1Ljc4NCwxMTcuNzIsNDQxLjc4NCwxMjEuNzJ6IiBmaWxsPSIjMDAwMDAwIi8+Cgk8L2c+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg=="/>
                                </a>
                            </td>
                        </tr>
                    <?php } // End if loop - Below is end foreach loop 
                } ?>  
                    
                <!-- End foreach loop Lists -->
            <?php } ?>
    </table>


<script src="app.js"></script>
</body>
</html>

