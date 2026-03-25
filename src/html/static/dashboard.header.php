<?php require_once 'src/utils/actions/dashboard.php'; ?>
<?php
$userCurrency = getUserCurrency();
?>
<!DOCTYPE html>
<html data-bs-theme="dark">
    <head>
        <title>Example<?= !empty($currPage) ? " - {$currPage}" : ""; ?></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
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
        <script src="src/javascript/actions/dashboard.js"></script>
        <script>
            jQuery(document).ready(() => {
                setInterval(getNews, 5000);
                getNews();

                setInterval(claimGold, 5000);
                claimGold();
            });
        </script>
    </head>

    <body class="container-fluid">
        <div class="jumbotron jumbotron-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <h1>Knightly Adventures v0.0.1</h1>
                </div>
                <div class="col-sm-6">
                    <h3 class="display-4"><?= !empty($currPage) ? " - {$currPage}" : ""; ?></h3>
                </div>
                <div class="col-sm-2">
                    <nav class="navbar navbar-expand-lg bg-body-tertiary">
                        <div class="container-fluid">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCurrency" aria-controls="navbarCurrency" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarCurrency">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                <a class="nav-link"><span id="usergold"><?= $userCurrency['Gold'] ?></span> Gold</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="#">
                                <div data-bs-toggle="modal" data-bs-target="#gemsModal"><span id="usergems"><?= $userCurrency['Diamonds'] ?></span> Gems</div>
                                    <div class="modal fade" id="gemsModal" tabindex="-1" aria-labelledby="gemModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="gemModalLabel">Purchase Gems or Membership</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Add purchases here.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                </li>
                                 <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Settings
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Account Details</a></li>
                                    <li><a class="dropdown-item" href="index.php?logout=true">Logout</a></li>
                                </ul>
                            </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Add notification center here. -->
        <div class="alert alert-secondary" role="alert">
            <?php
            if (!empty($_SESSION['username'])) {
                echo "<h5>Welcome, {$_SESSION['username']}!</h5>";
            }
            ?>
            <div id="newsitem">
            </div>
        </div>
        <!-- Add buttons for different things here. -->
        <div>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-sm">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarUserInput" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarUserInput">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link" href="dashboard.php?action=village">Village</a>
                        </li>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Fight
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Enemy</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item disabled" id="wbs_menu" href="#">World Boss</a></li>
                        </ul>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#">Heroes</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#">Items</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#">Chests</a>
                        </li>
                        <?php 
                        if (isPermitted("admin")) {
                            ?><li class="nav-item"><a class="nav-link" href="dashboard.php?action=admin">Admin Panel</a></li><?php
                        }
                        ?>
                        <li class="nav-item">
                        <a class="nav-link" href="dashboard.php?action=_example">DB Explainer (_example)</a>
                        </li>
                    </ul>
                    </div>
                </div>
            </nav>
        </div>