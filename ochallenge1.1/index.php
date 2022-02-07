<?php
session_start();
if (!isset($_SESSION['username']))
{
    header('Location: login.php');
}
$connect = mysqli_connect('localhost', 'ncvinh', 'vinh2000', 'task_manager');
mysqli_set_charset($connect, "utf8");
?>
<html>
<head>
	<title>Task Manage</title>
	<meta charset="utf-8">
    <style>
        td, th { 
    padding: 10px;
}
table { 
    width: 1000px;
    text-align: center;
    border-spacing: 10px;
    border-collapse: separate;
}
table, tr {
  border: 1px solid black;
  border-collapse: collapse;
}
    </style>
</head>
<body>
	<div>
    <h1 style="font-family: 'Courier New', Courier, monospace;" >Task Manage</h1>
    <?php
$username = $_SESSION['username'];
if (isset($_POST['newtask']))
{
    $str = $_POST['newtask'];
    $sql = "INSERT INTO tasks (username, task) values ('$username', '$str')";
    $query = mysqli_query($connect, $sql);
    // echo "<script type='text/javascript'>alert('Thành công!');</script>";
    
}

if (isset($_POST['del']))
{
    $id = $_POST['del'];
    $sql = "update tasks set status = 3  where id = '$id'";
    $query = mysqli_query($connect, $sql);
    header("Refresh:0");
}

if (isset($_POST['finish']))
{
    $id = $_POST['finish'];
    $sql = "update tasks set status = 1, finish_time = curdate()  where id = '$id'";
    $query = mysqli_query($connect, $sql);
    header("Refresh:0");
}

$sql = "Select * from users where username = '$username'";
$query = mysqli_query($connect, $sql);
$fullname = mysqli_fetch_array($query) ["fullname"];
echo "Chào mừng $fullname!<br><br><br>"
?>

    <form action = "" method = "POST">
    <textarea rows="4" cols="50" id="newtask" name = "newtask" >Nội dung</textarea><br>
    <input type = "submit" value = "Tạo task">
    </form>
    <br><br>
    <div style="">
    <h2>Danh sách các task</h2>
    <?php
$sql = "Select id, task, status, create_time, finish_time from tasks where username = '$username' and (status = 0 or status = 1)";
$query = mysqli_query($connect, $sql);
echo "<table>";
echo "<tr><th>Task</th><th>Trạng thái</th><th>Ngày tạo</th><th>Ngày hoàn thành</th><th>Hành động</th></tr>";
while ($row = mysqli_fetch_array($query))
{
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['task']) . "</td>";
    $status = "Đang làm";
    if ($row['status'] == 1)
    {
        $status = "Hoàn thành";
    }
    echo "<td>" . $status . "</td>";
    echo "<td>" . htmlspecialchars($row['create_time']) . "</td>";
    echo "<td>" . htmlspecialchars($row['finish_time']) . "</td>";
    echo "<td>";
    echo "<form method = 'POST'><button type='submit' name='del' value='" . $row['id'] . "'>Xoá</button></form>";
    if ($row['status'] != 1)
    {
        echo "<form method = 'POST'><button type='submit' name='finish' value='" . $row['id'] . "'>Hoàn thành</button></form>";
    }
    echo "</td>";
    echo "</tr>";
}
echo "</table>";
?>
    </div>
    
</div>
</body>
</html>
