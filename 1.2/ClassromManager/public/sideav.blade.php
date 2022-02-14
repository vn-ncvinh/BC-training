<style>
    body {
        font-family: "Lato", sans-serif;
    }

    .sidenav {
        height: 100%;
        width: 250px;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: cornflowerblue;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
    }

    .sidenav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: black;
        display: block;
        transition: 0.3s;
    }

    .sidenav a:hover {
        color: #f1f1f1;
    }


    #main {
        transition: margin-left .5s;
        padding: 16px;
        margin-left: 250px;
    }

    @media screen and (max-height: 450px) {
        .sidenav {
            padding-top: 15px;
        }

        .sidenav a {
            font-size: 18px;
        }
    }
</style>
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
    }
</script>
<div id="mySidenav" class="sidenav">
    <a href="/">Users</a>
    <a href="/messages">Messages</a>
    <a href="/assignments">Assignments</a>
    <a href="/challenges">Challenges</a>
    <a href="/logout">Logout</a>
</div>

<div id="sidenav">
    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
</div>