//ascii pairs 48: 0 57: 9 65: A 90: Z
var values = [48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74,
    75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90];
var total_tries = 0;
var within_tries = 0;
var match = 0;
var pairs = 0;
var fid = 0;
var sid = 0;
var allid = ["#b00", "#b01", "#b02", "#b03", "#b10", "#b11", "#b12", "#b13", "#b20", "#b21", "#b22", "#b23", "#b30", "#b31", "#b32", "#b33"];
var allpid = ["#p00", "#p01", "#p02", "#p03", "#p10", "#p11", "#p12", "#p13", "#p20", "#p21", "#p22", "#p23", "#p30", "#p31", "#p32", "#p33"];
var inMatch = false;

function display(selected_id) {
    if (within_tries < 2) {
        if (within_tries === 0 && inMatch === false) {
            total_tries++;
            within_tries++;
            fid = "#" + selected_id;
            indx = allid.indexOf(fid); //get the index for the key and p tag
            ptag = allpid[indx];
            console.log("fid" + fid);
            revealText(ptag);
            inMatch = true;
            $(ptag).fadeIn(0);
            $(ptag).fadeOut(3000);
            setTimeout(() => {
                inMatch = false;
                fid = 0;
            }, 3000);
        } else if (within_tries === 1) {
            if (("#" + selected_id) != fid) {
                within_tries++;
                sid = "#" + selected_id;
                console.log("second clicked" + sid);
                indx2 = allid.indexOf(sid); //get the index for the key and p tag
                ptag2 = allpid[indx2];
                revealText(ptag2);
                compareids(fid, sid);
            };
        };
    };
};

function revealText(clicked_id) {
    idx = allpid.indexOf(clicked_id); //get the index for the key and p tag
    fill = keys[idx];
    $(clicked_id).text(fill);
};

function compareids(fid, sid) {
    $(allpid[allid.indexOf(fid)]).stop();
    $(allpid[allid.indexOf(fid)]).fadeIn(0);
    $(allpid[allid.indexOf(sid)]).fadeIn(0);

    idx1 = allid.indexOf(fid);
    fill1 = keys[idx1];
    p1 = allpid[idx1];
    idx2 = allid.indexOf(sid);
    fill2 = keys[idx2];
    p2 = allpid[idx2];
    if (fill1 === fill2) {
        match = 1;
        inMatch = false;
        pairs++;
        console.log(match);
        if (pairs === 8) {
            alert("You used " + total_tries + " number of tries.")
        }
    } else {
        $(p1).fadeOut(3000);
        $(p2).fadeOut(3000);
    };
    within_tries = 0;
};

function clearText(clearid) {
    $(clearid).html("");
};



//get a random number inclusive
function randomNumber(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
};

var eight = []
var keys = []
// get 8 pairs of letters or numbers and place pairs into each button
function getkeypairs() {
    while (eight.length < 8) {
        // can choose from 36 values (10 number digits and 26 letters)
        select = randomNumber(1, 36) - 1;
        val_select = values[select];
        s_val_select = String.fromCharCode(val_select);
        //console.log(val_select);
        if (eight.includes(s_val_select, 0) == false) {
            eight.push(s_val_select);
        };
    };
    //console.log(eight);
    var doub = eight.concat(eight);
    //console.log(doub);
    var check_dict = new Object();
    while (keys.length < 16) {
        select2 = randomNumber(1, doub.length) - 1;
        val_select2 = doub[select2];
        //console.log(keys.length, val_select2)
        if (keys.includes(val_select2, 0) == false) {
            keys.push(val_select2);
            check_dict[val_select2] = 1;
        } else {
            if (check_dict[val_select2] < 2) {
                keys.push(val_select2);
                check_dict[val_select2] = 2;
            }
        }
    }
    console.log(keys);
};

window.onload = getkeypairs;