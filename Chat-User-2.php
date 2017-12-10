<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="style-2.css" />

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <script
        src="https://code.jquery.com/jquery-3.2.1.js"
        integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
        crossorigin="anonymous">
    </script>
    <script>
        function Ajax(){
            var req = new XMLHttpRequest();
            req.onreadystatechange = function () {
                if(req.readyState == 4 && req.status == 200)
                {
                    document.getElementById('chat_box_ID').innerHTML = req.responseText;

                }
            }
            req.open('GET' , 'chat_box.php', true);
            req.send();

        }

        setInterval(function () {
            scrolldata()
            Ajax()
        }, 1000)
    </script>

</head>

<body onload="Ajax();">




<div class="sidenav">
    <div id='wrapper'>
        <div id='content'>

            <?php include("left-nav.php"); ?>

        </div>
    </div>
</div>



<div class="content">
<div id = "wrapper">
    <h1>Chat with me !</h1>
    <div class = "chat_wrapper">

        <div id= "chat">

            <div id = "chat_box_ID">

            </div>

        </div>

        <form action="chatallusersids.php" method = "POST" >
            <textarea name ="message" , cols="30" , rows="10" class = "textarea"></textarea>
        </form>

    </div>
    <h3><p>Welcome !<a href="index.php">Taste of India</a></p></h3>

</div>
</div>
</body>
</html>



<script>
    $('.textarea').keyup(function (e) {
        if(e.which == 13) {
            $('form').submit();
        }
    });


</script>



<script>

    function scrolldata() {
        var height = 0;
        $('div').each(function (i, value) {
            height += parseInt($(this).height());
        });
        height += '';
        $('#chat').animate({scrollTop: height});
    }
</script>




