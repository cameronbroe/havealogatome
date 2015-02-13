<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Have a Logatome!</title>
        <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#generatingMessage").hide();
                $("#blackOverlay").hide();

                $("#genWord").click(function() {
                    $("#generatingMessage").show();
                    $("#blackOverlay").hide();

                    // Get form data to send through GET
                    var seedValue = $("#seedParam").val();

                    $.ajax({
                        type: "GET",
                        url: "src/Logatome/GetWord.php",
                        data: { seed: seedValue }
                    })
                        .done(function (response) {
                            $("#generatingMessage").hide();
                            $("#blackOverlay").hide();
                            //alert("Word generated.")
                            generated = JSON.parse(response);
                            $("#word").html(generated.word);
                            console.log(response);
                        })
                        .beforeSend(function() {
                            $("#generatingMessage").show();
                        })
                    ;
                });
            });
        </script>
    </head>
    <body>
        <div id="generatingMessage"><div id="centerText">Generating word...please wait<br /><img id="loadingImg" src="./img/loading.gif" /></div></div>
        <div id="wrapper">

            <form id="options">
                <input type="text" id="seedParam" value="3" />
                <input type="button" id="genWord" value="Generate Word" />
            </form>
            <br /><br />
            <div id="generatedWord">Generated word: <div id="word"></div></div>
        </div>
    </body>
</html>
