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

		echo serialize($_POST),"<br>";
		$electionTitle = str_replace(" ", "-", $_POST["selectedElection"]);
		echo $electionTitle,"<br>";
		
		if(is_file("election-data/activeElections.txt"))
		{
			$activeElections = unserialize(file_get_contents("election-data/activeElections.txt"));
			echo serialize($activeElections),"<br>";
			if(is_array($activeElections))
			{
				$elecIt=0;
				for(; $elecIt<max(array_keys($activeElections["elections"]))+1; $elecIt++)
				{
					echo $elecIt, ", Election: ", $activeElections["elections"][$elecIt], ", ";
					if(strcmp($activeElections["elections"][$elecIt], $electionTitle) == 0)
					{
						echo "Found Title <br>";
						unset($activeElections["elections"][$elecIt]);
						break;
					}
					
				}
				$file = fopen("election-data/activeElections.txt","w") or die("OOOOOOOOOh NOOOOOOOOOOOOO");
				fwrite($file, serialize($activeElections));
				fclose($file);
				
				$closedElections = unserialize(file_get_contents("election-data/closedElections.txt"));
				if(!is_array($closedElections))
				{
					$closedElections = array("elections"=>$elections);
				}
				$closedElections["elections"][max(array_keys($closedElections["elections"]))+1] = $electionTitle;
				
				$closedElectionsFile = fopen("election-data/closedElections.txt","w") or die("asdf");
				echo serialize($closedElections), "<br>";
				fwrite($closedElectionsFile, serialize($closedElections));
				fclose($closedElectionsFile);
			}
		}

    ?>
	<br><br>
		<p><a class="btn btn-primary btn-lg" href="frontPage.html" role="button">Return to the home page</a><p>
		<hr>
        <p>

        </p>


</body></html>
