<?php
session_start();
if (!isset($_SESSION["number"]))
{
	$_SESSION["number"] = 0; //number of question the user is on
	$_SESSION["correct"] = 0; // how many questions is answered correctly
	$_SESSION["uname"] = "";
	$_SESSION["bgntime"] = 0;
};

$number = $_SESSION["number"];
$correct = $_SESSION["correct"];
$uname = $_SESSION["uname"];
$bgntime = $_SESSION["bgntime"];
$total_number = 6;
$total_score = 60;

print <<<TOP
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Music Theory Quiz</title>
    <meta charset="UTF-8" />
    <meta name="description" content="Grace Chiu Music Theory Quiz" />
    <meta name="author" content="Grace Chiu" />
    <link href="music-quiz2.css" rel="stylesheet">
</head>
<body>
<div id="top">
	<p>
		<b>
			<span> Music Theory Quiz Login</span><br />
		</b>
	</p>
</div>
<script>function checkempty(cname){
	var allboxes = document.getElementsByClassName(cname);
	var isempty = 0; // nothing is checked
	for (var i = 0; i < allboxes.length; i++){
		if (allboxes[i].checked){
			isempty = 1;
		};
	};
	if ( isempty === 0){
		alert('Please answer this question before proceeding.');
		return false;
	}
	return true;
}</script>
TOP;

if ($_POST["page"] == "Login")
{
	rlogin();
}
elseif ($_POST["page"] == "Go to question two")
{
	$number = 2;
}
elseif ($_POST["page"] == "Go to question three")
{
	$number = 3;
}
elseif ($_POST["page"] == "Go to question four")
{
	$number = 4;
}
elseif ($_POST["page"] == "Go to question five")
{
	$number = 5;
}
elseif ($_POST["page"] == "Go to question six")
{
	$number = 6;
}
elseif ($_POST["page"] == "Submit")
{
	$number = 7; // show scoring
} else 
{
	loginPage();
};

/*function gotocookie($number){
	if (isset($_COOKIE["onquestion"]))
	{
		$oncookie = $_COOKIE["onquestion"];
		if ($number === $oncookie){
			
		};
	};
};*/

if ($number === 2) //grade q1 and display q2
{
	//setcookie ("onquestion", 1, time() + 60*15);
	$script = $_SERVER['PHP_SELF'];
	$ansone = $_POST["q1"];
	$cur = 0;
	$number = checkpast($bgntime, $number);
	if ($number === 8){
		$actual_score = $correct * 10;
		echo "<p>Sorry, you ran out 15 minutes to take the quiz.</p>";
		echo "<p>Your final score is $actual_score out of $total_score.</p>";
		session_destroy();
		return;
	};
	if ($ansone == 3){
		$correct += 1;
		$cur += 1;
        $_SESSION["correct"] = $correct;
	};
	$earnedpts = $cur*10;
	updatepts($uname, $earnedpts);
    echo "<p>You got $earnedpts points from the previous question.</p>"; 
	print <<<qtwo
	<form method = "post" action = $script>
        <div id="tf">
            <h3> True / False </h3>
            <p><b>2.</b> Melodic minor raises both the 6th and the 7th by a half step in natural minor.</p>
            <input type="radio" id="q2t" name="q2" value="1">
            <label for="q2t">a) True</label><br>
            <input type="radio" id="q2f" name="q2" value="3" required>
            <label for="q2f">b) False</label><br /><br />
		</div>
		<div id="actions">
            <input type="submit" name = "page" value="Go to question three" id="submit"/>
            <input type="reset" value="Clear" id="reset" />
        </div>
	</form>
qtwo;
} elseif ($number === 3) //grade q2 and display q3
{
	$script = $_SERVER['PHP_SELF'];
	$anstwo = $_POST["q2"];
	$cur = 0;
	$number = checkpast($bgntime, $number);
	if ($number === 8){
		$actual_score = $correct * 10;
		echo "<p>Sorry, you ran out 15 minutes to take the quiz.</p>";
		echo "<p>Your final score is $actual_score out of $total_score.</p>";
		session_destroy();
		return;
	};
	if ($anstwo == 1){
		$correct += 1;
		$cur += 1; // 1 if q2 is answered correctly
        $_SESSION["correct"] = $correct;
	};
	$earnedpts = $cur*10;
	updatepts($uname, $earnedpts);
	echo "<p>You got $earnedpts points from the previous question.</p>"; 
	print <<<qthree
	<form method = "post" action = $script onsubmit = "return checkempty('q3')">
        <div id="mc">
            <h3> Multiple Choice </h3>
            <p><b>3.</b> Which of these is NOT a good practice for composition considered in the Common Practice Period?</p>
            <input type="checkbox" class="q3" id="q3contrary" name="q3[]" value="1">
            <label for="q3contrary"> a) Contrary motion</label><br />
            <input type="checkbox" class="q3" id="q3tendency" name="q3[]" value="2">
            <label for="q3tendency"> b) Double tendency tones</label><br />
            <input type="checkbox" class="q3" id="q3crossed" name="q3[]" value="3">
            <label for="q3crossed"> c) No crossed voices</label><br />
            <input type="checkbox" class="q3" id="q3root" name="q3[]" value="4">
            <label for="q3root"> d) Double root of the chord</label><br />
		</div>
		<div id="actions">
            <input type="submit" name = "page" value="Go to question four" id="submit"/>
            <input type="reset" value="Clear" id="reset" />
        </div>
	</form>
qthree;
} elseif ($number === 4)
{
	$script = $_SERVER['PHP_SELF'];
	$ansthree = $_POST["q3"];
	$cur = 0;
	$number = checkpast($bgntime, $number);
	if ($number === 8){
		$actual_score = $correct * 10;
		echo "<p>Sorry, you ran out 15 minutes to take the quiz.</p>";
		echo "<p>Your final score is $actual_score out of $total_score.</p>";
		session_destroy();
		return;
	};
	if (($ansthree[0] == 2) and (count($ansthree) == 1)){
		$correct += 1;
		$cur += 1;
        $_SESSION["correct"] = $correct;
	};
	$earnedpts = $cur*10;
	updatepts($uname, $earnedpts);
	echo "<p>You got $earnedpts points from the previous question.</p>"; 
	print <<<qfour
	<form method = "post" action = $script onsubmit = "return checkempty('q4')">
        <div id="mc">
            <h3> Multiple Choice </h3>
            <p><b>4.</b> This second inversion chord has a leaping bass. </p>
            <input type="checkbox" class="q4" id="q4passing" name="q4[]" value="1">
            <label for="q4passing"> a) Passing</label><br />
            <input type="checkbox" class="q4" id="q4pedal" name="q4[]" value="2">
            <label for="q4pedal"> b) Pedal</label><br />
            <input type="checkbox" class="q4" id="q4arpeg" name="q4[]" value="3">
            <label for="q4arpeg"> c) Arpeggiated</label><br />
            <input type="checkbox" class="q4" id="q4caden" name="q4[]" value="4">
            <label for="q4caden"> d) Cadential</label><br /><br />
        </div>
		<div id="actions">
            <input type="submit" name = "page" value="Go to question five" id="submit"/>
            <input type="reset" value="Clear" id="reset" />
        </div>
	</form>
qfour;
} elseif ($number === 5)
{
	$script = $_SERVER['PHP_SELF'];
	$ansfour = $_POST["q4"];
	$cur = 0;
	$number = checkpast($bgntime, $number);
	if ($number === 8){
		$actual_score = $correct * 10;
		echo "<p>Sorry, you ran out 15 minutes to take the quiz.</p>";
		echo "<p>Your final score is $actual_score out of $total_score.</p>";
		session_destroy();
		return;
	};
	if (($ansfour[0] == 3) and (count($ansfour) == 1)){
		$correct += 1;
		$cur += 1;
        $_SESSION["correct"] = $correct;
	};
	$earnedpts = $cur*10;
	updatepts($uname, $earnedpts);
	echo "<p>You got $earnedpts points from the previous question.</p>"; 
	print <<<qfive
	<form method = "post" action = $script>
        <div id="fb">
            <h3> Fill in the Blank </h3>

            <b>5)</b> _______ is a contrapuntal composition which employs a melody with one or more imitations.<br />
            <input type="text" id="q5t" name="q5" size="10" required/><br /><br />
        </div>
		<div id="actions">
            <input type="submit" name = "page" value="Go to question six" id="submit"/>
            <input type="reset" value="Clear" id="reset"/>
        </div>
	</form>
qfive;
} elseif ($number === 6)
{
	$script = $_SERVER['PHP_SELF'];
	$ansfive = $_POST["q5"];
	$cur = 0;
	$lowerfive = strtolower($ansfive);
	$number = checkpast($bgntime, $number);
	if ($number === 8){
		$actual_score = $correct * 10;
		echo "<p>Sorry, you ran out 15 minutes to take the quiz.</p>";
		echo "<p>Your final score is $actual_score out of $total_score.</p>";
		session_destroy();
		return;
	};
	if ($lowerfive == "canon"){
		$correct += 1;
		$cur += 1;
        $_SESSION["correct"] = $correct;
	};
	$earnedpts = $cur*10;
	updatepts($uname, $earnedpts);
	echo "<p>You got $earnedpts points from the previous question.</p>"; 
	print <<<qsix
	<form method = "post" action = $script>
        <div id="fb">
            <h3> Fill in the Blank </h3>
            <b>6)</b> A musical scale or mode with five notes per octave instead of the normal seven is called a ________.<br />
            <input type="text" id="q6t" name="q6" size="10" required/><br /><br />
        </div>
		<div id="actions">
            <input type="submit" name = "page" value="Submit" id="submit"/>
            <input type="reset" value="Clear" id="reset" />
        </div>
	</form>
qsix;
} elseif ($number === 7)
{
    $script = $_SERVER['PHP_SELF'];
	$anssix = $_POST["q6"];
	$cur = 0;
	$lowersix = strtolower($anssix);
	$number = checkpast($bgntime, $number);
	if ($number === 8){
		$actual_score = $correct * 10;
		echo "<p>Sorry, you ran out 15 minutes to take the quiz.</p>";
		echo "<p>Your final score is $actual_score out of $total_score.</p>";
		session_destroy();
		return;
	};
	if ($lowersix == "pentatonic"){
		$correct += 1;
		$cur += 1;
        $_SESSION["correct"] = $correct;
	};
	$earnedpts = $cur*10;
	updatepts($uname, $earnedpts);
	echo "<p>You got $earnedpts points from the previous question.</p>"; 
	$actual_score = $correct * 10;
	print <<<finalscreen
finalscreen;
	echo "<p>Your final score is $actual_score out of $total_score.</p>";
	session_destroy();
};

print <<<BOTTOM
</body>
</html>
BOTTOM;

function rlogin()
{
	$script = $_SERVER['PHP_SELF'];
	$storeall =array(); // dict of username as key and password pairs
	$store =array(); // only store username in txt

	# pre work load info in txt
	if ($info = fopen("passwd.txt", "r"))
	{
		while (!feof($info))
		{
			$line = fgets($info);
			$split = explode(":", $line);
			# gets rid of extra space in password
			$uname = $split[0];
			$psd = preg_replace('/\s+/',' ',trim($split[1]));
			# key value pair of username to password
			$storeall[$uname] = $psd;
			array_push($store, $uname);
		}
		fclose($info);
	};

	# check if user input is valid and store in txt
	if ($_POST['page'] == "Login")
	{
		#Get form data
		$nameuser = $_POST["username"];
		$psduser = $_POST["password"];
		if (in_array($nameuser, $store))
		{ 
			echo '<script>alert("This username has taken the quiz already.")</script>';
			loginPage();
		} else {
			if ($addinfo = fopen("passwd.txt", "a"))
			{
				fwrite($addinfo, "$nameuser:".$psduser."\n");
			};
			fclose($addinfo);
			$_SESSION["uname"] = $nameuser;
			$bgntime = microtime(true);
			$_SESSION["bgntime"] = $bgntime;
			$number = 1; 
			$script = $_SERVER['PHP_SELF'];
			//echo "<script>setTimeout(function(){ $number = 8; <p>Your final score is $actual_score out of $total_score.</p>; session_destroy();}, 15000);</script>";
	print <<<qone
	<form method = "post" action = $script>
        <div id="tf">
            <h3> True / False </h3>
            <p><b>1.</b> A perfect fifth has five half steps.</p>
            <input type="radio" id="q1t" name="q1" value="1">
            <label for="q1t">a) True</label><br>
            <input type="radio" id="q1f" name="q1" value="3" required>
            <label for="q1f">b) False</label><br /><br />
		</div>
		<div id="actions">
            <input type="submit" name = "page" value="Go to question two" id="submit"/>
            <input type="reset" value="Clear" id="reset" />
        </div>
	</form>
qone;
		};
	};
};

function loginPage()
{
	$script = $_SERVER['PHP_SELF'];
	print<<<lpp
		<div id="content">
			<form action="$script" method="post">

				<p>You must login to take the quiz. Each user only has one attempt, and the quiz only lasts for <b>15</b> minutes.</p>
				<p>There are six questions in total, each worths 10 points. The perfect score is 60 points, no partial credit is given.</p>
                <table id="input">
					<tr>
						<td><b>Username</b></td>
						<td>
							<label for="usern">
								<input type="text" name="username" id="usern" size="20" />
							</label>
						</td>
					</tr>
					<tr>
						<td><b>Password</b></td>
						<td>
							<label for="pw">
								<input type="password" name="password" id="pw" size="20" />
							</label>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" name="page" value="Login" id="submit"/>
							<input type="reset" value="Clear" id="reset" />
						</td>
					</tr>
				</table>
			</form>
		</div>
lpp;
};

function checkpast($bgntime, $number){
	$submitt = microtime(true);
	$difft = $submitt - $bgntime;
	if ($difft > 900){
		return 8;
	};
	return $number;
};

function updatepts($uname, $earnedpts)
{
	$curinfo = array();
	$base = 0;
	if ($info = fopen("results.txt", "r"))
		{
			while (!feof($info))
			{
				$line = fgets($info);
				$split = explode(":", $line);
				# gets rid of extra space in password
				$name = $split[0];
				$psd = preg_replace('/\s+/',' ',trim($split[1]));
				if ($name != $uname){
					$curinfo[$name] = $psd;
				} else {
					$base = $psd;
				};
			};
			fclose($info);
		};
	$fin = $base + $earnedpts;
	if ($winfo = fopen("results.txt", "w"))
		{
			if (count($curinfo) > 0){
				foreach($curinfo as $key=>$value) {
					if ((strlen($key) != 0)){
						fwrite($winfo, "$key:".$value."\n");
					};
				};
			};		
			if ((strlen($uname) != 0)){
				fwrite($winfo, "$uname:".$fin."\n");
			};
			fclose($winfo);
		};
};

?>


