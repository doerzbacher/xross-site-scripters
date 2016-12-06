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
		$results = unserialize(file_get_contents("election-data/{$electionTitle}.ballot"));
		
		echo "<br><br><br>";
		echo $electionTitle,"<br><br>";
		echo serialize($electionBallot), "<br><br>";
		echo serialize($electionBallotCollection), "<br><br>";
		
		if(is_array($electionBallot) && is_array($electionBallotCollection))
		{
			if(!is_null($electionBallot["title"]))
			{
				if(is_null($results["voteCount"]))
				{
					array_push($results["voteCount"]=array(array(),array(),array(),array(),array(),array()));
				}
				echo serialize($results),"<br><br>";
					
				for($raceIt=0; $raceIt<=max(array_keys($electionBallot["entries"])); $raceIt++)
				{
					echo "Race num: ",$raceIt,"<br>";
					foreach($electionBallotCollection["completedBallots"] as $ballotSer)
					{
						//	echo $ballot["candidates"][$raceIt][$entryIt],"<br>";
						//echo serialize($ballot),"<br>";
						$ballot = unserialize($ballotSer);
						//echo serialize($ballot["candidates"]),"<br>";
						if(!is_null($ballot["candidates"][$raceIt][0]))
						{
							if(is_null($results["voteCount"][$raceIt][$ballot["candidates"][$raceIt][0]]))
							{
								$results["voteCount"][$raceIt][$ballot["candidates"][$raceIt][0]] = 0;
							}
							$results["voteCount"][$raceIt][$ballot["candidates"][$raceIt][0]]++;
							echo $ballot["candidates"][$raceIt][0],"<br>";
							//echo serialize($results),"<br>";
						}else
						{
							echo "Entry Null<br>";
						}
					}
					echo "<br>";
				}
			}
		}
		
		echo serialize($results),"<br>";
		
		$resultsFile = fopen("election-data/results/{$electionTitle}.results","w");
		fwrite($resultsFile, serialize($results));
		fclose($resultsFile);
		
    ?>
	</body>
</html>
