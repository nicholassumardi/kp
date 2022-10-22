function notif(text, background) {
    Snackbar.show({
        text: text,
        pos: 'top-center',
        actionTextColor: '#fff',
        backgroundColor: background
    });
}

function loadingOpen(selector) {
    $(selector).waitMe({
        effect: 'stretch',
        text: 'Please Wait ...',
        bg: 'rgba(255,255,255,0.7)',
        color: '#000',
        waitTime: -1,
        textPos: 'vertical'
    });
}

function loadingClose(selector) {
    $(selector).waitMe('hide');
}

function formatNPM(npm){

    var number =npm.value;
    var lngth = number.length;
    if (lngth == 2 || lngth == 7 || lngth == 9) {
      number = number + ".";
    } else if (lngth >20 ) {
     number = number.slice(0,20);
    }
	npm.value = number;
}