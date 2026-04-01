async function setHeroLineup(heroNumber, slotNumber) {
    const data = await jQuery.ajax({
        url: "ajax.php?do=heroLineup",
        method: "post",
        data: {
            hero: heroNumber,
            slot: slotNumber
        },
        success: (response) => {
            console.log(response);
            res = JSON.parse(response);
        }
    });

    if (res['status'] == true) {

        console.log('FUCKING FINALLY!');

    }
    else {
        console.log('Fuck.');
    }
}