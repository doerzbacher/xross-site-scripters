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
		
		if(is_file("election-data/closedElections.txt"))
		{
			$closedElections = unserialize(file_get_contents("election-data/closedElections.txt"));
			echo serialize($closedElections),"<br>";
			if(is_array($closedElections))
			{
				$elecIt=0;
				for(; $elecIt<max(array_keys($closedElections["elections"]))+1; $elecIt++)
				{
					echo $elecIt, ", Election: ", $closedElections["elections"][$elecIt], ", ";
					if(strcmp($closedElections["elections"][$elecIt], $electionTitle) == 0)
					{
						echo "Found Title <br>";
						unset($closedElections["elections"][$elecIt]);
						break;
					}
					echo "<br>";
					
				}
				$file = fopen("election-data/closedElections.txt","w") or die("OOOOOOOOOh NOOOOOOOOOOOOO");
				fwrite($file, serialize($closedElections));
				fclose($file);
				
				$certifiedElections = unserialize(file_get_contents("election-data/closedElections.txt"));
				if(!is_array($certifiedElections))
				{
					$certifiedElections = array("elections"=>$elections);
				}
				$certifiedElections["elections"][count($certifiedElections["elections"])] = $electionTitle;
				
				$certifiedElectionsFile = fopen("election-data/certifiedElections.txt","w") or die("asdf");
				echo serialize($certifiedElections), "<br>";
				fwrite($certifiedElectionsFile, serialize($certifiedElections));
				fclose($certifiedElectionsFile);
			}
		}

    ?>
	<br><br>
		<p><a class="btn btn-primary btn-lg" href="frontPage.html" role="button">Return to the home page</a><p>
		<hr>
        <p>

        </p>


</body></html>
