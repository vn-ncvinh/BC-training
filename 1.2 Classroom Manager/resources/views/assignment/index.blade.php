<html>

<head>
    <title>Assignment</title>
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

            <H1>Assignments</H1>
            @if(Session::get('role') == 1)
            <div>
                <a href="assignments/create">
                    <button>Create</button>
                </a>
            </div>
            @endif
            <br>
            <table align=center>
                <tr>
                    <th>Dueto</th>
                    <th>description</th>
                    <th>Action</th>
                </tr>
                @foreach($list as $data)
                <tr>
                    <td>{{$data->deadline}}</td>
                    <td>{{$data->description}}</td>
                    <td>
                        <a href="assignments/detail/{{$data->id}}">
                            <button>Detail</button>
                        </a>
                        @if(Session::get('role') == 1)
                        <a href="assignments/delete/{{$data->id}}">
                            <button>Delete</button>
                        </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>

</html>