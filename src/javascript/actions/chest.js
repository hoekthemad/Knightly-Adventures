async function openChest(chestID) {
    const data = await jQuery.ajax({
        url: "ajax.php?do=chestOpening",
        method: "post",
        data: { chest: chestID },
        success: (response) => {
            console.log(response);
            res = JSON.parse(response);
        }
    });

    if (res['status'] == true) {
        jQuery(`#caseresult1`).text('Spinning in 3... 2... 1...');
        await delay(4000);

        let timeDelay = 200;

        for (let i = 0; i < 25; i++) {

            jQuery(`#caseresult1`).text(res['itemamount' + i] + " " + res['itemname' + i]);


            await delay(timeDelay);

            if (i < 7) {
                timeDelay += 20
            }
            else if (i < 13) {
                timeDelay += 50
            }
            else if (i < 17) {
                timeDelay += 100
            }
            else if (i < 21) {
                timeDelay += 150
            }
            else {
                timeDelay += 300
            }

            if (i == 23) {
                jQuery(`#caseresult1`).text("You win:");
                jQuery(`#caseresult2`).text(res['itemamount' + i] + " " + res['itemname' + i]);
            }

        }



        jQuery(`#caseresult`).text(res['winitemamount'] + " " + res['winitemname']);
    }
}

function delay(seconds) {
  return new Promise(resolve => setTimeout(resolve, seconds));
}