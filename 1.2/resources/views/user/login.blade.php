<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>
    <title>Classroom Manager</title>
    <link href="css/taskmanage.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->
            <div class="fadeIn first">
                <h1 style="font-family: 'Courier New', Courier, monospace; color: cornflowerblue; padding-top: 1ch;">Đăng nhập</h1>
            </div>
            @if (\Session::has('message'))
            <div class="alert alert-success">
                {!! \Session::get('message') !!}
            </div>
            @endif
            <!-- Login Form -->
            <form action="" method="POST">
                @csrf
                <input type="text" id="username" class="fadeIn second" name="username" placeholder="Tài khoản">
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="Mật khẩu">
                <input type="submit" class="fadeIn fourth" value="Đăng nhập">
            </form>


        </div>
    </div>
</body>

</html>