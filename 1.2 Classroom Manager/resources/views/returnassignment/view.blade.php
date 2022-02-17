<html>

<head>
    <title>Assignment [{{$assignment->description}}]</title>
    <style>
        body {
            background-color: grey;
        }

        .center-div {
            display: flex;
            justify-content: center;
            /* align-items: center; */
            text-align: center;
            min-height: 100vh;
        }

        .main-panel {
            background-color: whitesmoke;
            width: 80%;
            height: 80%;
            border-radius: 5px;
            padding-bottom: 24px;
        }

        table {
            text-align: center;
            border-collapse: collapse;
            table-layout: fixed;
            width: 95%;
        }

        th {
            background-color: gray;
        }

        table,
        td,
        th {
            padding: 20px;
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <?php
    include "sideav.blade.php";
    ?>
    <div class="center-div" id="main">
        <div class="main-panel">

            <H1>Assignment [{{$assignment->description}}]</H1>

            <div>
                File: <a href="/assignments/{{$assignment->id}}/file/">{{$assignment->filename}}
                </a>
                @if (\Session::has('message'))
                <div class="alert alert-success">
                {!! \Session::get('message') !!}
                </div>
                @endif
                <br><br>
                <form id="Updatefile" action="" method="POST" enctype="multipart/form-data" style="display: none;">
                    @csrf
                    <input type="file" name="assignmentfile" require />
                    <button type="submit">Update</button>
                </form>
                <script>
                    function showformupdatefile() {
                        if (document.getElementById('Updatefile').style.display == 'block') {
                            document.getElementById('Updatefile').style.display = 'none';
                        } else {
                            document.getElementById('Updatefile').style.display = 'block';
                        }

                    }
                </script>
                <button id="showbtn" onclick="showformupdatefile()">Change File</button>
                <br>
                <br>
                <a style="color: red;">Due to: {{$assignment->deadline}}</a>
            </div>
            <br>
            <table align=center>
                <tr>
                    <th>Time submit</th>
                    <th>File</th>
                    <th>Student</th>
                </tr>
                @foreach($list as $turnin)
                <tr>
                    <td>{{$turnin->submit_time}}</td>
                    <td><a href="/assignments/{{$assignment->id}}/{{$turnin->username}}">{{$turnin->filename}}</a></td>
                    <td>{{$turnin->fullname}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>

</html>