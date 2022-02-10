<html>

<head>
    <title>Task Manage</title>
    <meta charset="utf-8">
    <style>
        button {
            width: 150px
        }

        table {
            width: 1000px;
            text-align: center;
            border-spacing: 10px;
            border-collapse: separate;
        }

        table,
        tr {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body align=center>
    <h1 style="font-family: 'Courier New', Courier, monospace;">Task Manage</h1>
    Chào mừng {{$user->fullname }}<br><br>
    <form action="" method="POST">
        @csrf
        <textarea rows="4" cols="50" id="content" name="content">Nội dung</textarea><br>
        <br>
        <input type="submit" value="Tạo task">
    </form>
    <br><br>
    <div>
        <h2>Danh sách các task</h2>
        <table align=center>
            <tr>
                <th>Task</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th>Ngày hoàn thành</th>
                <th>Hành động</th>
            </tr>
            @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->content }}</td>
                <td>
                    @if($task->status == 1)
                    Hoàn thành
                    @else
                    Đang làm
                    @endif
                <td>{{$task->create_time}}</td>
                <td>{{$task->finish_time}}</td>
                <td>
                <br>
                <form method ="POST">@csrf<button type="submit" name="delete" value="{{$task->id}}">Xoá</button></form>
                <form method ="POST">@csrf<button type="submit" name="finish" value="{{$task->id}}">Hoàn thành</button></form>
                </td>
            </tr>

            @endforeach
        </table>
    </div>
</body>

</html>