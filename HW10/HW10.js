function check() {
    var q1a;
    var q1ac;
    var q2a;
    var q2ac;
    var q3a;
    var q3ac;
    var c3 = 0;
    var q4a;
    var q4ac;
    var c4 = 0;
    var q5a = document.getElementById("q5").value;
    var q6a = document.getElementById("q6").value;
    var grade = 0;
    corans = ["canon", "pentatonic"];
    status = true;

    // check if all questions are answered, if yes, grade quiz, if no, alert
    while (status) {
        var q1as = document.getElementsByName("q1");
        for (let i = 0; i < q1as.length; i++) {
            if (q1as[i].checked) {
                q1a = q1as[i].value;
            }
        }
        if (q1a === q1ac) {
            alert("Please answer all of the questions.");
            status = false;
            break;
        }

        var q2as = document.getElementsByName("q2");
        for (let i = 0; i < q2as.length; i++) {
            if (q2as[i].checked) {
                q2a = q2as[i].value;
            }
        }
        if (q2a === q2ac) {
            alert("Please answer all of the questions.");
            status = false;
            break;
        }

        var q3as = document.getElementsByName("q3");
        for (let i = 0; i < q3as.length; i++) {
            if (q3as[i].checked) {
                q3a = q3as[i].value;
                c3++;
            }
        }
        if (q3a === q3ac) {
            alert("Please answer all of the questions.");
            status = false;
            break;
        }

        var q4as = document.getElementsByName("q4");
        for (let i = 0; i < q4as.length; i++) {
            if (q4as[i].checked) {
                q4a = q4as[i].value;
                c4++;
            }
        }
        if (q4a === q4ac) {
            alert("Please answer all of the questions.");
            status = false;
            break;
        }

        if ((q5a.length == 0) || (q6a.length == 0)) {
            alert("Please answer all of the questions.");
            status = false;
            break;
        }
        break;
    }

    if (status === "true") {
        console.log(q3a)
        console.log(q4a)
        // check accuracy on multiple choice questions, q1 false, q2 true; option true returns 1, false returns 3
        if (parseInt(q1a) < 2) {
            grade = grade;
        } else {
            grade += 1;
        }
        if (parseInt(q2a) > 2) {
            grade = grade;
        } else {
            grade += 1;
        }
        console.log(c3)
        // check accuracy on multiple choice questions, q3 2, q4 3; select more than one box is wrong, no matter if checked correct
        if ((parseInt(q3a) != 2) || (parseInt(c3) > 1)) {
            grade = grade;
        } else {
            grade += 1;
        }
        if ((parseInt(q4a) != 3) || (parseInt(c4) > 1)) {
            grade = grade;
        } else {
            grade += 1;
        }
        // check accuracy on fill in the blank questions, exact spelling, upper and lower mix allowed
        var q5al = q5a.toLowerCase();
        q5al = q5al.trim();
        if (q5al != corans[0]) {
            grade = grade;
        } else {
            grade += 1;
        }
        var q6al = q6a.toLowerCase();
        q6al = q6al.trim();
        if (q6al != corans[1]) {
            grade = grade;
        } else {
            grade += 1;
        }
    }

    // grade in alert box
    if (status === "true") {
        alert("Your grade is " + grade + " / 6 .");
    }
}