<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>
    <title>Create new Challenge</title>
    <link href="/css/taskmanage.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <?php
    include 'sideav.blade.php';
    ?>
    <div id="main">
        <div class="wrapper fadeInDown">
            <div id="formContent">
                <!-- Tabs Titles -->
                <div class="fadeIn first">
                    <h1 style="font-family: 'Courier New', Courier, monospace; color: cornflowerblue; padding-top: 1ch;">New Assignment</h1>
                </div>
                @if (\Session::has('message'))
                <div class="alert alert-success">
                    {!! \Session::get('message') !!}
                </div>
                @endif
                <!-- Login Form -->
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" id="name" class="fadeIn second" name="name" placeholder="Name" required>
                    <input type="text" id="hint" class="fadeIn second" name="hint" placeholder="Hint" required>
                    <input type="file" id="challengefile" class="fadeIn second" name="challengefile" accept=".txt" required>
                    <input type="submit" class="fadeIn fourth" value="Add" id="regbtn">
                </form>

            </div>
        </div>
    </div>
</body>

</html>