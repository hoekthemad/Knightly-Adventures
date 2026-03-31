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

        const button = document.getElementById(`chestclaim${chestID}button`);
        button.disabled = true;

        jQuery(`#chest${chestID}result1`).text('Spinning in 3... 2... 1...');
        jQuery(`#chest${chestID}result2`).text('');
        jQuery(`#chest${chestID}result4`).text('');
        await delay(4000);


        let timeDelay = 250;
        const winningNumber = 14;

        for (let i = 2; i < (winningNumber + 1); i++) {

            jQuery(`#chest${chestID}result1`).text(res['itemspin' + (i - 2)]);
            jQuery(`#chest${chestID}result2`).text(res['itemspin' + (i - 1)]);
            jQuery(`#chest${chestID}result3`).text('> ' + res['itemspin' + i] + ' <');
            jQuery(`#chest${chestID}result4`).text(res['itemspin' + (i + 1)]);
            jQuery(`#chest${chestID}result5`).text(res['itemspin' + (i + 2)]);

            await delay(timeDelay);

            if (i < 7) {
                timeDelay += 25
            }
            else if (i < 11) {
                timeDelay += 100
            }
            else {
                timeDelay += 250
            }

            if (i === winningNumber) {
                jQuery(`#chest${chestID}result1`).text("You win:");
                jQuery(`#chest${chestID}result2`).text('');
                jQuery(`#chest${chestID}result4`).text('');
                jQuery(`#chest${chestID}result5`).text('')
            }

        }
        button.disabled = false;
    }
    else {

        jQuery(`#chest${chestID}result1`).text(res['message1']);
        jQuery(`#chest${chestID}result2`).text(res['message2']);

    }
}

function delay(seconds) {
  return new Promise(resolve => setTimeout(resolve, seconds));
}