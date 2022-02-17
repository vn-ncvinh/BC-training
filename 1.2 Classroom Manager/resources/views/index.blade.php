<html>

<head>
    <title>Users</title>
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
        
            <H1>List Users</H1>
            @if(Session::get('role') == 1)
            <div>
                <a href="user/create">
                <button>Create</button>
            </a>
            </div>
            @endif
            <br>
            <table align=center>
                <tr>
                    <th>Username</th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                @foreach($list as $data)
                <tr>
                    <td>{{$data->username}}</td>
                    <td>{{$data->fullname}}</td>
                    <td>{{$data->email}}</td>
                    <td>{{$data->phonenumber}}</td>
                    @if($data->role==1)
                    <td>Teacher</td>
                    @else
                    <td>Student</td>
                    @endif
                    <td>
                    <a href="user/detail/{{$data->username}}">
                            <button>Detail</button>
                        </a>
                        @if(Session::get('role') == 1 || Session::get('username')==$data->username)
                        @if(Session::get('username')==$data->username || $data->role==0)
                        <a href="user/update/{{$data->username}}">
                            <button>Update</button>
                        </a>
                        <a href="user/delete/{{$data->username}}">
                            <button>Delete</button>
                        </a>
                        @endif
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>

</html>