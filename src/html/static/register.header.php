<?php
?>
<!DOCTYPE html>
<html data-bs-theme="dark">
    <head>
        <title>Example<?= !empty($currPage) ? " - {$currPage}" : ""; ?></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-4.0.0.js" crossorigin="anonymous"></script>
        <script>
            jq = $.noConflict();
        </script>
        <link rel="stylesheet" href="src/javascript/alertifyjs/css/alertify.css">
        <link rel="stylesheet" href="src/javascript/alertifyjs/css/themes/bootstrap.css">
        <script src="src/javascript/alertifyjs/alertify.js"></script>
        <script type="text/javascript">        
            //override defaults
            alertify.defaults.transition = "zoom";
            alertify.defaults.theme.ok = "ui positive button";
            alertify.defaults.theme.cancel = "ui black button";
            alertify.alert().setting('modal', true);
            alertify.confirm().setting('modal', true);
        </script>   
    </head>

    <body class="container-fluid">
        <div class="jumbotron jumbotron-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <h1>Kightly Adventure</h1>
                </div>
                <div class="col-sm-6">
                    <h3 class="display-4">Register for an account</h3>
                </div>
                <div class="col-sm-3">
                    
                </div>
            </div>
        </div>