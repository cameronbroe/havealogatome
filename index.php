<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Have a Logatome!</title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $.ajax({
                    type: "GET",
                    url: "src/Logatome/GetWord.php"
                })
                .done(function(response) {
                    alert("Word generated.")
                    console.log(response);
                });
            });
        </script>
    </head>
    <body>
        <div id="word"></div>
    </body>
</html>
