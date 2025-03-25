<?php
require('first.php');

session_start();
$user = $_SESSION['loggedin_user'];

if ($user === null) {
  header('location: signin.php');
}



class TaskTracker extends First
{
  public function createTask($task, $tasktime)
  {
    $completed = 0;
    $user = $_SESSION['loggedin_user'];
    $id = $user['id'];

    $query = "INSERT INTO `tasks_tb` (task, time, completed, user_id) VALUES(?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('ssii', $task, $tasktime, $completed, $id);
    $saveToDb = $stmt->execute();

    // $stmt = new mysqli_stmt($query);
    // $stmt->bind_param('ssii', $task, $tasktime, $completed, $id);
    // $saveToDb = $stmt->execute();

    if ($saveToDb) {
      return ['status' => true, 'message' => 'Task added successfully'];
    } else {
      return ['status' => false, 'message' => 'Task not added'];
    }
  }
}

if (isset($_POST['add-task'])) {
  $task = $_POST['task'];
  $tasktime = $_POST['task-time'];
  $taskTracker = new TaskTracker();
  $response = $taskTracker->createTask($task, $tasktime);
  print_r($response);
}


?>










<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task Tracker</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

  <body style="background-color:rgba(13, 109, 253, 0.61) ;">
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
              <h3>Task Tracker</h3>
            </div>
            <div class="card-body">
              <form action="" method="post">
                <div class="mb-3">
                  <label for="task" class="form-label">Task</label>
                  <input type="text" class="form-control" id="task" name="task" placeholder="Enter Your Task">
                </div>
                <div class="mb-3">
                  <label for="task-time" class="form-label">Task-time</label>
                  <input type="time" class="form-control" id="task-time" name="task-time" placeholder="Enter Your Task-time">
                </div>
                <div class="d-grid">
                  <button class="btn btn-primary" name="add-task" type="submit">Add Task</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>

</html>