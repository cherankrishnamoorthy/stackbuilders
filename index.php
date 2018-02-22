<?php

$message="";

require_once("vendor/autoload.php");
use App\Src\CreditCardProcessor;

if(!empty($_POST)){


    $cardProcessor = new CreditCardProcessor(intVal($_POST['cardNumber']));
    $message = $cardProcessor->cardProcessedMessage();
}


?>


<html>
    <head>
        <title> Stackbuilders CC Validation</title>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    </head>

<body>
<div class="container">
    <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">

            <div class="col-4 text-center">
                <a class="blog-header-logo text-dark" href="#"><img itemprop="image" src="public/images/logo.png   " alt="Stack Builders logo"></a>
            </div>

            <div class="col-4 pt-1">
                <a class="text-muted" href="#"> <h5 class="">Stackbuilders CC Validation</h5></a>
            </div>
            <div class="col-4">
                &nbsp;
            </div>

        </div>


        <div class="row flex-nowrap justify-content-between align-items-center">

            <div class="col-12 text-center">
                <hr />
                <br />

                <br />

                <?php if(!empty($message)): ?>

                    <div class="alert-info">
                        <?= $message ?>
                    </div>
                <?php endif; ?>


                <br />
                <form method="POST" action="" >

                    <input type="text" name="cardNumber">
                    <input type="submit" value="Submit" />
                </form>
            </div>
        </div>



    </header>

    <div class="col-12">




    </div>

</div>



</body>

</html>