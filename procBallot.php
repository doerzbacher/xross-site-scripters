<html><head>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<title>Matt Gramlich Lab 4: PHP</title>
		<link rel="stylesheet" type="text/css" href="bootstrap.css">
		<style>
            h1 {font-size:25px;}
        </style>
		<script>

			function changePage()
			{
			    navDrop = document.getElementById("navDropDown");
			    window.location.href = navDrop.value;
			}

		</script>
	</head>

	<body>
	<?php

		//need to get election title from form
		$electionTitle = str_replace(" ", "-", $_POST["selectedElection"]);
		
		$fileContent = unserialize(file_get_contents("election-data/results/{$electionTitle}.results"));
		if(!is_array($fileContent))
		{
			$arr = array();
			$fileContent = array("completedBallots"=>$arr);
		}
		
		$fileContent["completedBallots"][count($fileContent["completedBallots"])] = serialize($_POST);
		
		foreach($fileContent["completedBallots"] as $completedBallot)
		{
			echo serialize($completedBallot), "<br>";
		}
		
        $file = fopen("election-data/results/{$electionTitle}.results","w") or die("Oh No! Cannot open file!");

        fwrite($file, serialize($fileContent));
        fclose($file);
        echo("wrote array");

        /*header("Location: frontPage.html");*/ /*http://stackoverflow.com/questions/2112373/php-page-redirect*/

    ?>
	<br><br>
		<p><a class="btn btn-primary btn-lg" href="frontPage.html" role="button">Return to the home page</a><p>
		<hr>
        <p>

        </p>


</body></html>
