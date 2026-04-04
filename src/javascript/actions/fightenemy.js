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
            jQuery(`#hero${i}name`).text('');
            jQuery(`#hero${i}inslot`).text('');
            jQuery(`#hero${i}level`).text('');
            jQuery(`#hero${i}health`).text('');
            jQuery(`#hero${i}element`).text('');
            jQuery(`#hero${i}attack`).text('');
            jQuery(`#hero${i}defense`).text('');
        }

        for (let i = 0; i < res['herocount']; i++) {
            jQuery(`#hero${i}name`).text(res['heroname' + i]);
            jQuery(`#hero${i}inslot`).text('Slot: ' + res['heroinslot' + i] + ' / ' + res['herocount']);
            jQuery(`#hero${i}level`).text('L: ' + res['heroreawaken' + i] + ' - ' + res['herolevel' + i]);
            jQuery(`#hero${i}health`).text('H: ' + res['herohealth' + i] + ' / ' + res['herohealthmax' + i]);
            jQuery(`#hero${i}element`).text('E: ' + res['heroelement' + i]);
            jQuery(`#hero${i}attack`).text('A: ' + res['heroattack' + i]);
            jQuery(`#hero${i}defense`).text('D: ' + res['herodefense' + i]);
        }

        for (let i2 = 0; i2 < 6; i2++) {
            jQuery(`#enemy${i2}name`).text('');
            jQuery(`#enemy${i2}inslot`).text('');
            jQuery(`#enemy${i2}level`).text('');
            jQuery(`#enemy${i2}health`).text('');
            jQuery(`#enemy${i2}element`).text('');
            jQuery(`#enemy${i2}attack`).text('');
            jQuery(`#enemy${i2}defense`).text('');
        }

        for (let i2 = 0; i2 < res['enemycount']; i2++) {
            jQuery(`#enemy${i2}name`).text(res['enemyname' + i2]);
            jQuery(`#enemy${i2}inslot`).text('Slot: ' + res['enemyinslot' + i2] + ' / ' + res['enemycount']);
            jQuery(`#enemy${i2}level`).text('L: ' + res['enemyreawaken' + i2] + ' - ' + res['enemylevel' + i2]);
            jQuery(`#enemy${i2}health`).text('H: ' + res['enemyhealth' + i2] + ' / ' + res['enemyhealth' + i2]);
            jQuery(`#enemy${i2}element`).text('E: ' + res['enemyelement' + i2]);
            jQuery(`#enemy${i2}attack`).text('A: ' + res['enemyattack' + i2]);
            jQuery(`#enemy${i2}defense`).text('D: ' + res['enemydefense' + i2]);
        }

    }
}

async function fightEnemy(unknown) {
    const data = await jQuery.ajax({
        url: "ajax.php?do=fightEnemy",
        method: "post",
        data: { noidea: unknown },
        success: (response) => {
            console.log(response);
            res = JSON.parse(response);
        }
    });

    if (res['status'] == true) {

    }
}

function delay(seconds) {
  return new Promise(resolve => setTimeout(resolve, seconds));
}