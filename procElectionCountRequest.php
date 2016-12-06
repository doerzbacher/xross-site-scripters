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
		
		$electionTitle = str_replace(" ", "-", $_POST["selectedElection"]);
		$electionBallot = unserialize(file_get_contents("election-data/{$electionTitle}.ballot"));
		$electionBallotCollection = unserialize(file_get_contents("election-data/results/{$electionTitle}.ballotCollection"));
		
		echo $electionTitle,"<br><br>";
		echo serialize($electionBallot), "<br><br>";
		echo serialize($electionBallotCollection), "<br><br>";
		
		if(is_array($electionBallot) && is_array($electionBallotCollection))
		{
			if(!is_null($electionBallot["title"]))
			{
				for($raceIt=0; $raceIt<=max(array_keys($electionBallot["entries"])); $raceIt++)
				{
					for($entryIt=1; $entryIt<=max(array_keys($electionBallot["entries"][$raceIt])); $entryIt++)
					{
						echo $electionBallot["entries"][$raceIt][$entryIt],", ";
						foreach($electionBallotCollection["completedBallots"] as $ballotSer)
						{
							//	echo $ballot["candidates"][$raceIt][$entryIt],"<br>";
							//echo serialize($ballot),"<br>";
							$ballot = unserialize($ballotSer);
							//echo serialize($ballot["candidates"]),"<br>";
							echo $ballot["candidates"][$raceIt][$entryIt-1],"<br>";
						}
					}
				}
			}
		}
		
    ?>
	</body>
</html>
