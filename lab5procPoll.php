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
	    $presidentVote=-1;
        if(empty($_POST["candidates"]))
        {
            echo("No input, ignoring");
            header("Location: frontPage.html"); /*http://stackoverflow.com/questions/2112373/php-page-redirect*/
            exit();
        }
        $presidentVote=$_POST["candidates"][0];

        $fileContent = unserialize(file_get_contents("poll1VoteCount.txt"));
        if(!is_array($fileContent))
        {
            echo("Could not load file, zeroed array <br>");
            $voteArray = array(0,0,0,0,0,0);
            $fileContent = array("candidates"=>$voteArray);
        }

        $file = fopen("poll1VoteCount.txt","w") or die("Oh No! Cannot open file!");

        $fileContent["candidates"][$presidentVote] = $fileContent["candidates"][$presidentVote] + 1;

        for($i=0; $i<count($fileContent["candidates"]); $i++)
        {
            $val = $fileContent["candidates"][$i];
            echo("candidates {$i}: {$val} <br>");
        }

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
