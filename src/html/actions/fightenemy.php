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
            <span id="herocard0"></span>
            <br>
            <span id="herocard1"></span>
            <br>
            <span id="herocard2"></span>
        </div>
        <div class="col-md-2">
            <span id="enemycard0"></span>
            <br>
            <span id="enemycard1"></span>
            <br>
            <span id="enemycard2"></span>
            <br>
            <span id="enemycard3"></span>
            <br>
            <span id="enemycard4"></span>
            <br>
            <span id="enemycard5"></span>
        </div>
        <div class="col-md-5">
            <div class="text-center">
                <span id="startfightbutton">
                </span>
                <br>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <span id="herocardfightcard">
                        </span>
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-5">
                        <span id="enemycardfightcard">
                        </span>
                    </div>
                </div>
                <br>
                <span id="startfight">
                </span>
            </div>
        </div>
    </div>
</div>