<html>

<head>
    <title>Challenges</title>
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
            width: 90%;
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
                <a href="/challenges/create">
                <button>Create</button>
            </a>
            </div>
            @endif
            <br>
            <table align=center>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                @foreach($challenges as $data)
                <tr>
                    <td>{{$data->name}}</td>
                    <td>
                    <a href="/challenges/detail/{{$data->id}}">
                            <button>Detail</button>
                        </a>
                        @if(Session::get('role') == 1)
                        <a href="/challenges/delete/{{$data->id}}">
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