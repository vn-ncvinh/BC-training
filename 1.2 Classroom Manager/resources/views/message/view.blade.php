<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{$data->fullname}}</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <style>
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
            width: 100%;

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

        .card {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }

        .gutters-sm {
            margin-right: -8px;
            margin-left: -8px;
        }

        .gutters-sm>.col,
        .gutters-sm>[class*="col-"] {
            padding-right: 8px;
            padding-left: 8px;
        }

        


        a:link {
            text-decoration: none;
        }

        .list-group-item {
            margin-bottom: 5px;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="font-family: Arial, Helvetica, sans-serif; background-color: gray">
    <?php
    include 'sideav.blade.php';
    ?>
    
    <div class="center-div" id="main">
        <div class="main-panel">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                    <img src="/v.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                        <h4>{{$data->fullname }}</h4>
                        <p class="text-secondary mb-1" style="font-family:'Courier New', monospace;">
                            @if($data->role==0)
                            Student
                            @elseif($data->role==1)
                            Teacher
                            @endif
                            <br>
                            <a href="mailto:{{$data->email}}">{{$data->email}}</a><br>
                            <a href="tel:{{$data->phonenumber}}">{{$data->phonenumber}}</a><br>

                        </p>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <ul class="list-group list-group-flush">
                    @if($data->username != Session::get('username'))
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap" style="margin-top: 5px;">
                        <h4>Message:</h4>
                        <form action="" method="post">
                            @csrf
                            <input name="content" /> <button type="submit">Gửi</button>
                        </form>
                    </li>
                    @endif
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap" style="margin-top: 5px;">
                        <h4>History</h4>
                        <table>
                            <tr>
                                <th>Time</th>
                                <th>From</th>
                                <th>Content</th>
                            </tr>
                            @foreach($messages as $message)
                            <tr>
                                <td>{{$message->time}}</td>
                                <td><a href="/user/detail/{{$message->from}}">{{$message->from}}</a></td>
                                <td>{{$message->content}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</body>

</html>