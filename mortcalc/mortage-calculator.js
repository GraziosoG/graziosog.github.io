function calc() {
    var P = document.getElementById("principal").value;
    var r = document.getElementById("rate").value;
    var t = document.getElementById("term").value;
    var pf = parseFloat(P); //float principal
    var rf = parseFloat(r); //float monthly rate
    var tf = parseFloat(t); //float num of months

    if (isNaN(pf) || isNaN(rf) || isNaN(tf) == true) {
        alert("Please enter valid input");
    } else if (pf < 0 || rf < 0 || tf < 0) {
        alert("Please enter non-negative values");
    } else if(tf < 0.5) {
        alert("Loan terms in months must be greater than 0.5 (therefore rounding to 1), see more instructions in the Notice section below");
    }
    else {
        rf = rf / 12;
        tf = Math.round(tf);
        out(pf, rf, tf);
    }
}


function out(P, r, n) {
    var R = P * r / (1 - (1 / (1 + r) ** n)); //monthly payment
    //R = R.toFixed(2);
    var T = R * n; //sum of all pauments
    //T = T.toFixed(2);
    var I = T - P; // total interest
    //I = I.toFixed(2);
    document.getElementById("month").value = R;
    document.getElementById("sum").value = T;
    document.getElementById("interest").value = I;
    //document.writeln("Monthly Payments" + R);
    //document.writeln("Sum of All Payments" + T);
    //document.writeln("Total Interest" + I);
}

// R = P * r / (1 - (1 / (1 + r)^n))
// R monthly payment, P principal, r = year rate / 12, n = num of months
// alert box of non-numeric values or neg, computation halted
// round months to nearest int, if user puts in fractional value
// computed answers to two decimal places

function clr() {
    var month = document.getElementById("month");
    var sum = document.getElementById("sum");
    var interest = document.getElementById("interest");
    month.readonly = false;
    sum.readonly = false;
    interest.readonly = false;
    month.value = "";
    sum.value = "";
    interest.value = "";
    month.readonly = true;
    sum.readonly = true;
    interest.readonly = true;
}