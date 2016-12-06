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

		$entries = $_POST["entries"];
		$numEntries = count($entries[0]);
		echo("numEntries: {$numEntries} <br><br> ");
		
		echo "Entry Test: ", $_POST["entries"][1][0], "<br>";
		
		
		$counter = 0;
		foreach($_POST["entries"] as $race)
		{
			foreach($race as $entry)
			{
				echo "{$counter}: ", "{$entry}", "<br>";
			}
			$counter = $counter + 1;
		}
		
		echo "counter: ", $counter, "<br>";
		
		//need to get election title from form
		$electionTitle = str_replace(" ", "-", $_POST["title"]);
		
//write election to active elections file
		$electionsContent = unserialize(file_get_contents("election-data/activeElections.txt"));
        if(!is_array($electionsContent))
        {
			$electionsContent = array("elections"=>$activeElections);
		}
		$electionsContent["elections"][count($electionsContent["elections"])] = $electionTitle;	
		echo "Number of activeElections: ", count($electionsContent["elections"]), "<br><br>";
		foreach($electionsContent["elections"] as $election)
		{
			echo "Election Name: ", $election, "<br>";
		}		
		$activeElectionsFile = fopen("election-data/activeElections.txt","w+") or die("No elections file");
		echo serialize($electionsContent), "<br>";
		fwrite($activeElectionsFile, serialize($electionsContent));
		fclose($activeElectionsFile);

//write election ballot file
		echo "File Name: ", "{$electionTitle}", "<br> <br>";
		$electionFile = fopen("election-data/{$electionTitle}.ballot","w");
		echo serialize($_POST), "<br>";
		echo serialize($entries), "<br>";
		fwrite($electionFile, serialize($_POST));
		
		fclose($electionFile);

    ?>
	<br><br>
		<p><a class="btn btn-primary btn-lg" href="frontPage.html" role="button">Return to the home page</a><p>
		<hr>
        <p>

        </p>


</body></html>
