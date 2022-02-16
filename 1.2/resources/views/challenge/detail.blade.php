<html>

<head>
    <title>Challenge [{{$challenge->name}}]</title>
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
    </style>
</head>

<body>
    <?php
    include "sideav.blade.php";
    ?>
    <div class="center-div" id="main">
        <div class="main-panel">

            <H1>Challenge [{{$challenge->name}}]</H1>

            <div>
                
                <br><br>
                @if (\Session::has('message'))
                {{Session::get('message')}}<br><br>
                @endif
                <a id="hint" style="display: none; color: green;">Hint: {{$challenge->hint}}</a>
                <script>
                    function showhint(){
                        if(document.getElementById('hint').style.display == 'block'){
                            document.getElementById('hint').style.display = 'none';
                        } else {
                            document.getElementById('hint').style.display = 'block';
                        }
                    }
                </script>
                <br>
                <button onclick="showhint()">Show hint</button>
                <br>
                <br>
                <br>
                <form action="" method="POST">
                    @csrf
                    Answer<br><input type="text" name="answer" require />
                    <br>
                    <br>
                    <button type="submit">Submit</button>
                </form>
                
            </div>
        </div>
    </div>
</body>

</html>