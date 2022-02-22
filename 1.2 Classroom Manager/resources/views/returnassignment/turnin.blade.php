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
                <br>
                <a style="color: red;">Due to: {{$assignment->deadline}}</a>
                
                @if($turnin)
                <br><br><br>
                You work: <a href="/assignments/{{$assignment->id}}/download/{{$turnin->username}}">{{$turnin->filename}}</a>
                <br>
                <br>
                <a href="/assignments/{{$assignment->id}}/undo">
                    <button>Undo Turn in</button>
                </a>
                @else
                <form action="/assignments/{{$assignment->id}}/turnin" method="POST" enctype="multipart/form-data"">
                    @csrf
                    <input type="file" name="turninfile" require/>
                <br>
                <button type="submit">Turn in</button>
                </form>
                @endif
            </div>
            <br>
        </div>
    </div>
</body>

</html>