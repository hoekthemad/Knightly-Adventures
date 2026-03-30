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
        jQuery(`#caseresult2`).text('');
        await delay(4000);

        let timeDelay = 750;

        for (let i = 0; i < 5; i++) {

            jQuery(`#caseresult1`).text(res['itemspin' + i]);

            delay(timeDelay);

            if (i === 4) {
                jQuery(`#caseresult1`).text("You win:");
                jQuery(`#caseresult2`).text(res['winningitem']);
            }

        }
    }
    else {

        jQuery(`#caseresult1`).text(res['message1']);
        jQuery(`#caseresult2`).text(res['message2']);

    }
}

function delay(seconds) {
  return new Promise(resolve => setTimeout(resolve, seconds));
}