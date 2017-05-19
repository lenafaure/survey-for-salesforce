<?php

$callId = $_GET['callid'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Satisfaction Survey</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href=" https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

    <script   src="https://code.jquery.com/jquery-3.1.0.min.js"   integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="   crossorigin="anonymous"></script>

<style>

    form {
        text-align: center;
    }

    legend {
        padding: 1em 0;
        background-color: #2c7db7;
        color: #fff;
    }

    fieldset {

    }
    .form-wrap {
        padding: 1em 0;
    }

    label input[type="radio"] ~ i.fa.fa-circle-o{
        color: #c8c8c8;    display: inline;
    }
    label input[type="radio"] ~ i.fa.fa-dot-circle-o{
        display: none;
    }
    label input[type="radio"]:checked ~ i.fa.fa-circle-o{
        display: none;
    }
    label input[type="radio"]:checked ~ i.fa.fa-dot-circle-o{
        color: #7AA3CC;    display: inline;
    }
    label:hover input[type="radio"] ~ i.fa {
        color: #7AA3CC;
    }

    input[type=radio] {
        display: none;
    }
</style>
</head>
<body>



    <form action="result.php" class="form-horizontal" method="post">

        <input type="hidden" name="callId" value="<?php echo $callId ?>">
        <fieldset>

            <!-- Form Name -->
            <legend>Customer Satisfaction Survey</legend>

            <!-- Multiple Radios (inline) -->
            <div class="form-wrap">
                <label class="col-md-12">How would you rate your call with our agent ?</label>
                <div class="col-md-12">
                    <label class="radio-inline" for="radios-0">
                        <p>1</p>
                        <input type="radio" name="radios" id="radios-0" value="1" checked="checked"><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i>
                    </label>
                    <label class="radio-inline" for="radios-1">
                        <p>2</p>
                        <input type="radio" name="radios" id="radios-1" value="2"><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i>
                    </label>
                    <label class="radio-inline" for="radios-2">
                        <p>3</p>
                        <input type="radio" name="radios" id="radios-2" value="3"><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i>
                    </label>
                    <label class="radio-inline" for="radios-3">
                        <p>4</p>
                        <input type="radio" name="radios" id="radios-3" value="4"><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i>
                    </label>
                    <label class="radio-inline" for="radios-4">
                        <p>5</p>
                        <input type="radio" name="radios" id="radios-4" value="5"><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i>
                    </label>
                </div>
            </div>

            <!-- Textarea -->
            <div class="form-wrap col-md-12">
                <label class="col-md-12" for="textarea">Do you have a comment or a question ?</label>
                <div class="col-md-12">
                    <textarea class="form-control" id="textarea" name="textarea"></textarea>
                </div>
            </div>

            <!-- Button -->
            <div class="form-wrap">
                <label class="col-md-4 control-label" for="singlebutton"></label>
                <div class="col-md-4">
                    <input type="submit" value="Done" class="btn btn-primary">
                </div>
            </div>

        </fieldset>
    </form>



<script>

    $(document).ready(function(){

        $("#submit").click(function{

            $.post(
                'connexion.php', // Un script PHP que l'on va créer juste après
                {
                    login : $("#username").val(),  // Nous récupérons la valeur de nos inputs que l'on fait passer à connexion.php
                    password : $("#password").val()
                },

                function(data){ // Cette fonction ne fait rien encore, nous la mettrons à jour plus tard
                },

                'text' // Nous souhaitons recevoir "Success" ou "Failed", donc on indique text !
            );

        });

    });

</script>
</body>
</html>