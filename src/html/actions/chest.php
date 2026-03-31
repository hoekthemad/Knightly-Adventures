<?php require_once 'src/utils/actions/chest.php'; ?>
<script src="src/javascript/actions/chest.js"></script>

<div class="container">
    <br>
    <div class="row">
        <div class="col-md-4">
            <div class="text-center">
                <button id="chest1button" onclick="openChest(1)" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Open Starting Chest
                </button>
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <span id="chest1result1"></span>
                                    <br>
                                    <span id="chest1result2"></span>
                                    <br>
                                    <span id="chest1result3"></span>
                                    <br>
                                    <span id="chest1result4"></span>
                                    <br>
                                    <span id="chest1result5"></span>
                                    <br>
                                    <span id="chest1result6"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Claim</button>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                Cost to open:
                <br>
                ?
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-center">
                <button id="chest2button" onclick="openChest(2)">Not Set Up</button>
                <div>
                    <span id="chest2result1"></span>
                    <br>
                    <span id="chest2result2"></span>
                    <br>
                    <span id="chest2result3"></span>
                    <br>
                    <span id="chest2result4"></span>
                    <br>
                    <span id="chest2result5"></span>
                    <br>
                    <span id="chest2result6"></span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-center">

            </div>
        </div>
    </div>
</div>