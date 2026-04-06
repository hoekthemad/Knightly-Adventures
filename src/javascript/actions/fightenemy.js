async function fightEnemyStage(userStage) {
    const data = await jQuery.ajax({
        url: "ajax.php?do=fightEnemyStage",
        method: "post",
        data: { stage: userStage },
        success: (response) => {
            console.log(response);
            res = JSON.parse(response);
        }
    });

    if (res['status'] == true) {

        for (let i = 0; i < 3; i++) {
            jQuery(`#herocard${i}`).html('');
            jQuery(`#hero${i}name`).text('');
            jQuery(`#hero${i}inslot`).text('');
            jQuery(`#hero${i}level`).text('');
            jQuery(`#hero${i}health`).text('');
            jQuery(`#hero${i}element`).text('');
            jQuery(`#hero${i}attack`).text('');
            jQuery(`#hero${i}defense`).text('');
        }

        for (let i = 0; i < res['herocount']; i++) {
            jQuery(`#herocard${i}`).html('<div class="card" style="width: 8rem;"><div class="card-body"><h5 class="card-title"><span id="hero' + i + 'name"></span></h5><h6 class="card-subtitle mb-2 text-muted"><span id="hero' + i + 'inslot"></span></h6><p class="card-text"><span id="hero' + i + 'level"></span><br><span id="hero' + i + 'health"></span><br><span id="hero' + i + 'attack"></span><br><span id="hero' + i + 'defense"></span><br><span id="hero' + i + 'element"></span></p></div></div>');
            jQuery(`#hero${i}name`).text(res['heroname' + i]);
            jQuery(`#hero${i}inslot`).text('Slot: ' + res['heroinslot' + i] + ' / ' + res['herocount']);
            jQuery(`#hero${i}level`).text('L: ' + res['heroreawaken' + i] + ' - ' + res['herolevel' + i]);
            jQuery(`#hero${i}health`).text('H: ' + res['herohealth' + i] + ' / ' + res['herohealthmax' + i]);
            jQuery(`#hero${i}element`).text('E: ' + res['heroelement' + i]);
            jQuery(`#hero${i}attack`).text('A: ' + res['heroattack' + i]);
            jQuery(`#hero${i}defense`).text('D: ' + res['herodefense' + i]);
        }

        for (let i2 = 0; i2 < 6; i2++) {
            jQuery(`#enemycard${i2}`).html('');
            jQuery(`#enemy${i2}name`).text('');
            jQuery(`#enemy${i2}inslot`).text('');
            jQuery(`#enemy${i2}level`).text('');
            jQuery(`#enemy${i2}health`).text('');
            jQuery(`#enemy${i2}element`).text('');
            jQuery(`#enemy${i2}attack`).text('');
            jQuery(`#enemy${i2}defense`).text('');
        }

        for (let i2 = 0; i2 < res['enemycount']; i2++) {
            jQuery(`#enemycard${i2}`).html('<div class="card" style="width: 8rem;"><div class="card-body"><h5 class="card-title"><span id="enemy' + i2 + 'name"></span></h5><h6 class="card-subtitle mb-2 text-muted"><span id="enemy' + i2 + 'inslot"></span></h6><p class="card-text"><span id="enemy' + i2 + 'level"></span><br><span id="enemy' + i2 + 'health"></span><br><span id="enemy' + i2 + 'attack"></span><br><span id="enemy' + i2 + 'defense"></span><br><span id="enemy' + i2 + 'element"></span></p></div></div>');
            jQuery(`#enemy${i2}name`).text(res['enemyname' + i2]);
            jQuery(`#enemy${i2}inslot`).text('Slot: ' + res['enemyinslot' + i2] + ' / ' + res['enemycount']);
            jQuery(`#enemy${i2}level`).text('L: ' + res['enemyreawaken' + i2] + ' - ' + res['enemylevel' + i2]);
            jQuery(`#enemy${i2}health`).text('H: ' + res['enemyhealth' + i2] + ' / ' + res['enemyhealth' + i2]);
            jQuery(`#enemy${i2}element`).text('E: ' + res['enemyelement' + i2]);
            jQuery(`#enemy${i2}attack`).text('A: ' + res['enemyattack' + i2]);
            jQuery(`#enemy${i2}defense`).text('D: ' + res['enemydefense' + i2]);
        }

        jQuery('#startfightbutton').html('<button type="button" class="btn btn-primary" onclick="fightEnemy(' + userStage + ')">Fight Stage ' + userStage + '</button>');

    }
}

async function fightEnemy(userStage) {
    const data = await jQuery.ajax({
        url: "ajax.php?do=fightEnemy",
        method: "post",
        data: { stage: userStage },
        success: (response) => {
            console.log(response);
            res = JSON.parse(response);
        }
    });

    if (res['status'] == true) {

        console.log('Start the fight... at some point.');

    }
}

function delay(seconds) {
    return new Promise(resolve => setTimeout(resolve, seconds));
}