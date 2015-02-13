<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Have a Logatome!</title>
        <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.11.3/themes/ui-darkness/jquery-ui.css">
        <link href='http://fonts.googleapis.com/css?family=Chewy' rel='stylesheet' type='text/css'>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script src="//code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#seedValue").html($("#seedParam").val());
                $("#generatingMessage").hide();

                $("#seedParam").slider({
                    value: 3,
                    min: 1,
                    max: 20,
                    step: 1,
                    slide: function(event, ui) {
                        $("#seedValue").html(ui.value);
                    }
                });

                $("#seedValue").html($("#seedParam").slider("value"));

                $("#genWord").click(function() {
                    $("#generatingMessage").show();

                    // Get form data to send through GET
                    var seedValue = $("#seedParam").slider("value");

                    $.ajax({
                        type: "GET",
                        url: "src/Logatome/GetWord.php",
                        data: { seed: seedValue }
                    })
                        .done(function (response) {
                            $("#generatingMessage").hide();
                            //alert("Word generated.")
                            generated = JSON.parse(response);
                            $("#word").html(generated.word);
                            console.log(response);
                        });
                });
            });
        </script>
    </head>
    <body>
        <!-- Position of this element is for the overlay while generating the word -->
        <div id="generatingMessage"><div id="centerText"><div id="fullBlack"">Generating word...please wait</div><br /><img id="loadingImg" src="./img/loading.gif" /></div></div>

        <div id="wrapper">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" style="color: #3399FF;">Have A Logatome!</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/">Home</a></li>
                    <li><a href="http://github.com/cameronbroe/havealogatome">Source</a></li>
                </ul>
                </div>
            </nav>
            <div class="container-fluid main-page-bg">
                <div class="jumbotron">
                    <h1>logatome - n.</h1>
                    <p>a fake word with no actual meaning that can be pronounced</p>
                </div>
                <form id="options">
                    <div class="row push-button-below">
                        <div class="col-md-2 col-md-offset-3 seedLabel">
                            <div class="col-xs-2">Seed:</div>
                            <div class="col-xs-1 col-xs-offset-2"><div id="seedValue"></div></div>
                        </div>
                        <div class="col-md-4">
                            <div id="seedParam"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="button"  class="btn" style="width: 100%;" id="genWord">Generate Word</button>
                        </div>
                    </div>
                </form>
                <br /><br />
                <div class="row">
                    <!-- <div class="col-md-4 col-md-offset-4"> -->
                        <div id="generatedWord" style=""><div id="word"></div></div>
                    <!-- </div> -->
                </div>

                <footer style="width: 100%; text-align: center; margin-top: 200px;">
                    Copyright &copy; 2015 Cameron Roe
                </footer>
            </div>
        </div>
    </body>
</html>
