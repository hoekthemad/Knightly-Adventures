<?php require_once 'src/utils/actions/fightenemy.php'; ?>
<script src="src/javascript/actions/fightenemy.js"></script>

<div class="container">
    <br>
    <div class="row">
        <div class="col-md-3">
            <div class="jumbotron-fluid">
                <h3>
                    Stages:
                </h3>
            </div>
            <div class="text-center">
                <?php
                    getUserStages();
                ?>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card" style="width: 8rem;">
                <div class="card-body">
                    <h5 class="card-title">
                        <span id="hero0name"></span>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <span id="hero0inslot"></span>
                    </h6>
                    <p class="card-text">
                        <span id="hero0level"></span>
                        <br>
                        <span id="hero0health"></span>
                        <br>
                        <span id="hero0attack"></span>
                        <br>
                        <span id="hero0defense"></span>
                        <br>
                        <span id="hero0element"></span>
                    </p>
                </div>
            </div>
            <br>
            <div class="card" style="width: 8rem;">
                <div class="card-body">
                    <h5 class="card-title">
                        <span id="hero1name"></span>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <span id="hero1inslot"></span>
                    </h6>
                    <p class="card-text">
                        <span id="hero1level"></span>
                        <br>
                        <span id="hero1health"></span>
                        <br>
                        <span id="hero1attack"></span>
                        <br>
                        <span id="hero1defense"></span>
                        <br>
                        <span id="hero1element"></span>
                    </p>
                </div>
            </div>
            <br>
            <div class="card" style="width: 8rem;">
                <div class="card-body">
                    <h5 class="card-title">
                        <span id="hero2name"></span>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <span id="hero2inslot"></span>
                    </h6>
                    <p class="card-text">
                        <span id="hero2level"></span>
                        <br>
                        <span id="hero2health"></span>
                        <br>
                        <span id="hero2attack"></span>
                        <br>
                        <span id="hero2defense"></span>
                        <br>
                        <span id="hero2element"></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card" style="width: 8rem;">
                <div class="card-body">
                    <h5 class="card-title">
                        <span id="enemy0name"></span>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <span id="enemy0inslot"></span>
                    </h6>
                    <p class="card-text">
                        <span id="enemy0level"></span>
                        <br>
                        <span id="enemy0health"></span>
                        <br>
                        <span id="enemy0attack"></span>
                        <br>
                        <span id="enemy0defense"></span>
                        <br>
                        <span id="enemy0element"></span>
                    </p>
                </div>
            </div>
            <br>
            <div class="card" style="width: 8rem;">
                <div class="card-body">
                    <h5 class="card-title">
                        <span id="enemy1name"></span>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <span id="enemy1inslot"></span>
                    </h6>
                    <p class="card-text">
                        <span id="enemy1level"></span>
                        <br>
                        <span id="enemy1health"></span>
                        <br>
                        <span id="enemy1attack"></span>
                        <br>
                        <span id="enemy1defense"></span>
                        <br>
                        <span id="enemy1element"></span>
                    </p>
                </div>
            </div>
            <br>
            <div class="card" style="width: 8rem;">
                <div class="card-body">
                    <h5 class="card-title">
                        <span id="enemy2name"></span>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <span id="enemy2inslot"></span>
                    </h6>
                    <p class="card-text">
                        <span id="enemy2level"></span>
                        <br>
                        <span id="enemy2health"></span>
                        <br>
                        <span id="enemy2attack"></span>
                        <br>
                        <span id="enemy2defense"></span>
                        <br>
                        <span id="enemy2element"></span>
                    </p>
                </div>
            </div>
            <br>
            <div class="card" style="width: 8rem;">
                <div class="card-body">
                    <h5 class="card-title">
                        <span id="enemy3name"></span>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <span id="enemy3inslot"></span>
                    </h6>
                    <p class="card-text">
                        <span id="enemy3level"></span>
                        <br>
                        <span id="enemy3health"></span>
                        <br>
                        <span id="enemy3attack"></span>
                        <br>
                        <span id="enemy3defense"></span>
                        <br>
                        <span id="enemy3element"></span>
                    </p>
                </div>
            </div>
            <br>
            <div class="card" style="width: 8rem;">
                <div class="card-body">
                    <h5 class="card-title">
                        <span id="enemy4name"></span>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <span id="enemy4inslot"></span>
                    </h6>
                    <p class="card-text">
                        <span id="enemy4level"></span>
                        <br>
                        <span id="enemy4health"></span>
                        <br>
                        <span id="enemy4attack"></span>
                        <br>
                        <span id="enemy4defense"></span>
                        <br>
                        <span id="enemy4element"></span>
                    </p>
                </div>
            </div>
            <br>
            <div class="card" style="width: 8rem;">
                <div class="card-body">
                    <h5 class="card-title">
                        <span id="enemy5name"></span>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <span id="enemy5inslot"></span>
                    </h6>
                    <p class="card-text">
                        <span id="enemy5level"></span>
                        <br>
                        <span id="enemy5health"></span>
                        <br>
                        <span id="enemy5attack"></span>
                        <br>
                        <span id="enemy5defense"></span>
                        <br>
                        <span id="enemy5element"></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            text 4
        </div>
    </div>
</div>