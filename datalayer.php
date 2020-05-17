<?php
 	function DBconnect(){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "to_do";
	
	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    return $conn;
	    }
	catch(PDOException $e)
	    {
	    echo "Connection failed: " . $e->getMessage();
	    }	
	};

	// Get all Lists and Tasks \\
	
	function readLists(){
        $conn = DBconnect();
        $query = $conn->prepare("SELECT * FROM lists");
        $query->execute();
        $result = $query->fetchAll();
        return $result;  
	}

	function readTasks(){
        $conn = DBconnect();
        $query = $conn->prepare("SELECT tasks.* FROM tasks, lists WHERE tasks.task_list_id = lists.list_id");
        $query->execute();
        $result = $query->fetchAll();
        return $result;  
	}

	// End of "Get all Lists and Tasks" \\
// <--------------------------------------> \\
		// Create Lists and Tasks \\

	function createList($data){
		$conn = DBConnect();
		$query = $conn->prepare("INSERT INTO lists (list_name) VALUES (:list_name)");
		$query->execute($data);
		$conn = null;
	}
	
	function createTask($data){
        $conn = DBConnect();
        for($i = 0; $i < $data['task_count']; $i++){
            $name_index = 'task_name'.$i;
            $info_index = 'task_info'.$i;
            $status_index = 'task_status'.$i;
            $duration_index = 'task_duration'.$i;
            $query = $conn->prepare("INSERT INTO tasks (task_name, task_info, task_status, task_list_id, task_duration) VALUES (:task_name, :task_info, :task_status, :task_list_id, :task_duration)");
            $query->bindParam(':task_name', $data[$name_index]);
            $query->bindParam(':task_info', $data[$info_index]);
            $query->bindParam(':task_status', $data[$status_index]);
            $query->bindParam(':task_duration', $data[$duration_index]);
            $query->bindParam(':task_list_id', $data['list_id']);
            $query->execute();
        }
        $conn = null;
    }

	// End of "Create Lists and Tasks" \\
// <--------------------------------------> \\
	// Function to delete Lists and Tasks \\

	function deleteList($list){
		$conn = DBConnect();
		$query = $conn->prepare("DELETE FROM lists WHERE list_id=:list");
		$query->execute([':list' => $list]);
		$conn = null;
		header("Location: ../index.php");
	}

	function deleteTask($task){
		$conn = DBConnect();
		$query = $conn->prepare("DELETE FROM tasks WHERE task_id=:task");
		$query->execute([':task' => $task]);
		$conn = null;
		header("Location: ../index.php");
	}

	// End of "Function to delete Lists and Tasks" \\
// <--------------------------------------> \\
	//  \\

    function editListConfirm($list){
        $conn = DBconnect();
        $query = $conn->prepare("UPDATE lists SET list_name = :list_name WHERE list_id=:list_id");
        $query->execute([':list_name'=>$list['list_name'], ':list_id'=>$list['list_id']]);
        $conn = null;
        header("Location: ../index.php");
    }

	function editTaskConfirm($task){
        $conn = DBconnect();
        $query = $conn->prepare("UPDATE tasks SET task_name = :task_name, task_info = :task_info, task_status = :task_status, task_duration = :task_duration WHERE task_id=:task_id");
        $query->execute([':task_name'=>$task['task_name'],':task_info'=>$task['task_info'],':task_status'=>$task['task_status'],':task_duration'=>$task['task_duration'], ':task_id'=>$task['task_id']]);
        $conn = null;
        header("Location: ../index.php");
	}