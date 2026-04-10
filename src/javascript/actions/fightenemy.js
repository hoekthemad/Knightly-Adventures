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
            jQuery(`#herocard${i}`).html('<div class="card" style="width: 7rem;"><div class="card-body"><h5 class="card-title"><span id="hero' + i + 'name"></span></h5><h6 class="card-subtitle mb-2 text-muted"><span id="hero' + i + 'inslot"></span></h6><p class="card-text"><span id="hero' + i + 'level"></span><br><span id="hero' + i + 'health"></span><br><span id="hero' + i + 'attack"></span><br><span id="hero' + i + 'defense"></span><br><span id="hero' + i + 'element"></span></p></div></div>');
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
            jQuery(`#enemycard${i2}`).html('<div class="card" style="width: 7rem;"><div class="card-body"><h5 class="card-title"><span id="enemy' + i2 + 'name"></span></h5><h6 class="card-subtitle mb-2 text-muted"><span id="enemy' + i2 + 'inslot"></span></h6><p class="card-text"><span id="enemy' + i2 + 'level"></span><br><span id="enemy' + i2 + 'health"></span><br><span id="enemy' + i2 + 'attack"></span><br><span id="enemy' + i2 + 'defense"></span><br><span id="enemy' + i2 + 'element"></span></p></div></div>');
            jQuery(`#enemy${i2}name`).text(res['enemyname' + i2]);
            jQuery(`#enemy${i2}inslot`).text('Slot: ' + res['enemyinslot' + i2] + ' / ' + res['enemycount']);
            jQuery(`#enemy${i2}level`).text('L: ' + res['enemyreawaken' + i2] + ' - ' + res['enemylevel' + i2]);
            jQuery(`#enemy${i2}health`).text('H: ' + res['enemyhealth' + i2] + ' / ' + res['enemyhealth' + i2]);
            jQuery(`#enemy${i2}element`).text('E: ' + res['enemyelement' + i2]);
            jQuery(`#enemy${i2}attack`).text('A: ' + res['enemyattack' + i2]);
            jQuery(`#enemy${i2}defense`).text('D: ' + res['enemydefense' + i2]);
        }

        jQuery('#startfightbutton').html('<button id="fightstart" type="button" class="btn btn-primary" onclick="fightEnemy(' + userStage + ')">Fight Stage ' + userStage + '</button>');

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

        for(let i = 0; i < res['maxuserstage']; i++) {
            let button = document.getElementById(`fight${(i + 1)}`);
            button.disabled = true;
        }

        const buttonMain = document.getElementById(`fightstart`);
        buttonMain.disabled = true;

        let heroSelector = 0;
        let enemySelector = 0;

        jQuery(`#herocardfightcard`).html('<div class="card" style="width: 8rem;"><div class="card-body"><h5 class="card-title"><span id="heronamefightcard"></span></h5><h6><span id="heroinslotfightcard"></span></h6><p class="card-text"><span id="herohealthfightcard"></span><br><span id="heroattackfightcard"></span><br><span id="herodefensefightcard"></span><br><span id="heroelementfightcard"></span></p></div></div>');

        jQuery(`#heronamefightcard`).text(res['heroname' + heroSelector]);
        jQuery(`#heroinslotfightcard`).text('slot: ' + res['heroinslot' + heroSelector]);
        jQuery(`#herohealthfightcard`).text('H: ' + res['herohealth' + heroSelector] + ' / ' + res['herohealthmax' + heroSelector]);
        jQuery(`#heroattackfightcard`).text('A: ' + res['heroattack' + heroSelector]);
        jQuery(`#herodefensefightcard`).text('D: ' + res['herodefense' + heroSelector]);

        jQuery(`#enemycardfightcard`).html('<div class="card" style="width: 8rem;"><div class="card-body"><h5 class="card-title"><span id="enemynamefightcard"></span></h5><h6><span id="enemyinslotfightcard"></span></h6><p class="card-text"><span id="enemyhealthfightcard"></span><br><span id="enemyattackfightcard"></span><br><span id="enemydefensefightcard"></span><br><span id="enemyelementfightcard"></span></p></div></div>');

        jQuery(`#enemynamefightcard`).text(res['enemyname' + enemySelector]);
        jQuery(`#enemyinslotfightcard`).text('slot: ' + res['enemyinslot' + enemySelector]);
        jQuery(`#enemyhealthfightcard`).text('H: ' + res['enemyhealth' + enemySelector] + ' / ' + res['enemyhealthmax' + enemySelector]);
        jQuery(`#enemyattackfightcard`).text('A: ' + res['enemyattack' + enemySelector]);
        jQuery(`#enemydefensefightcard`).text('D: ' + res['enemydefense' + enemySelector]);

        let combatStringArray = ["Starting fight!"];

        jQuery(`#startfight`).text(combatStringArray[0]);

        const delaytimer = 3000;

        await delay(delaytimer);

        const roundCount = 250;
        for (let i = 0; i < roundCount; i++) {

            // Hero attacks enemy.
            let heroAttacksEnemy = await fightEnemyUpdate('hero', res['heroinslot' + heroSelector], res['enemyid' + enemySelector], res['herolevel' + heroSelector], res['heroattack' + heroSelector], res['enemylevel' + heroSelector], res['enemyhealth' + enemySelector], res['enemydefense' + enemySelector]);
            combatStringArray.push(`You did ${heroAttacksEnemy} damage!`);

            res['enemyhealth' + enemySelector] -= heroAttacksEnemy;
            jQuery(`#enemyhealthfightcard`).text('H: ' + res['enemyhealth' + enemySelector] + ' / ' + res['enemyhealthmax' + enemySelector]);

            // Bulid the combat outlog.
            let combatString = "";
            for (let i2 = 0; i2 < combatStringArray.length; i2++) {
                combatString = "<div>" + combatStringArray[i2] + "</div>" + combatString;
            }
            jQuery(`#startfight`).html(combatString);

            await delay(delaytimer);

            // Enemy has been killed
            if (res['enemyhealth' + enemySelector] === 0) {
                combatStringArray.push(`${res['enemyname' + enemySelector]} has been killed!`);
                combatString = "<div>" + res['enemyname' + enemySelector] + " has been killed!</div>" + combatString;
                jQuery(`#startfight`).html(combatString);
                await delay(delaytimer);

                // Award EXP
                if (res2['levelupmainheroleveldifference']) {
                    if (res2['levelupmainheroleveldifference'] === 1) {
                        combatStringArray.push(`${res['heroname' + heroSelector]} has leveled up ${res2['levelupmainheroleveldifference']} level!`);
                        combatString = "<div>" + res['heroname' + heroSelector] + " has leveled up " + res2['levelupmainheroleveldifference'] + " level!</div>" + combatString;
                    }
                    else {
                        combatStringArray.push(`${res['heroname' + heroSelector]} has leveled up ${res2['levelupmainheroleveldifference']} levels!`);
                        combatString = "<div>" + res['heroname' + heroSelector] + " has leveled up " + res2['levelupmainheroleveldifference'] + " levels!</div>" + combatString;
                    }
                    jQuery(`#startfight`).html(combatString);
                    await delay(delaytimer);
                }
                if (res2['levelupuserprofileleveldifference']) {
                    if (res2['levelupuserprofileleveldifference'] === 1) {
                        combatStringArray.push(`Your profile has leveled up ${res2['levelupuserprofileleveldifference']} level!`);
                        combatString = "<div>Your profile has leveled up " + res2['levelupuserprofileleveldifference'] + " level!</div>" + combatString;
                    }
                    else {
                        combatStringArray.push(`Your profile has leveled up ${res2['levelupuserprofileleveldifference']} levels!`);
                        combatString = "<div>Your profile has leveled up " + res2['levelupuserprofileleveldifference'] + " levels!</div>" + combatString;
                    }
                    jQuery(`#startfight`).html(combatString);
                    await delay(delaytimer);
                }

                // There is another enemy in the lineup alive.
                if (res['enemyhealth' + (enemySelector + 1)]) {
                    enemySelector++

                    combatStringArray.push(`${res['enemyname' + enemySelector]} is next to the fight!`);
                    combatString = "<div>" + res['enemyname' + enemySelector] + " is next to the fight!</div>" + combatString;
                    jQuery(`#startfight`).html(combatString);

                    jQuery(`#enemynamefightcard`).text(res['enemyname' + enemySelector]);
                    jQuery(`#enemyinslotfightcard`).text('slot: ' + res['enemyinslot' + enemySelector]);
                    jQuery(`#enemyhealthfightcard`).text('H: ' + res['enemyhealth' + enemySelector] + ' / ' + res['enemyhealthmax' + enemySelector]);
                    jQuery(`#enemyattackfightcard`).text('A: ' + res['enemyattack' + enemySelector]);
                    jQuery(`#enemydefensefightcard`).text('D: ' + res['enemydefense' + enemySelector]);

                    await delay(delaytimer);
                }

                // No one else is alive in the enemy lineup.
                else {
                    i = roundCount;

                    /// Check if the user can advance a stage.

                    combatStringArray.push(`You have beat stage ${userStage}!`);
                    combatString = `<div>You have beat stage ${userStage}!</div>` + combatString;
                    jQuery(`#startfight`).html(combatString);
                    await delay(delaytimer);

                    /// Award item drops here!
                }
            }

            // Enemy Attacks
            if (res['enemyhealth' + enemySelector] > 0) {
                /// Set up later...
            }

        }

        for(let i = 0; i < res['maxuserstage']; i++) {
            let button = document.getElementById(`fight${(i + 1)}`);
            button.disabled = false;
        }
        buttonMain.disabled = false;

    }
}

function delay(seconds) {
    return new Promise(resolve => setTimeout(resolve, seconds));
}

async function fightEnemyUpdate(whoAttack, heroSlot, enemyID, attackerLevel, attackerAttack, defenderLevel, defenderHealth, defenderDefense) {
    const data = await jQuery.ajax({
        url: "ajax.php?do=fightEnemyUpdate",
        method: "post",
        data: {
            attack: whoAttack,
            hero: heroSlot,
            enemy: enemyID,
            attackerl: attackerLevel,
            attackera: attackerAttack,
            defenderl: defenderLevel,
            defenderh: defenderHealth,
            defenderd: defenderDefense
        },
        success: (response) => {
            console.log(response);
            res2 = JSON.parse(response);
        }
    });

    if (res['status'] == true) {

        return res2['finaldamage'];

    }
}