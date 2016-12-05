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
        if(empty($_POST["candidates"]))
        {
            echo("No input, ignoring");
            header("Location: frontPage.html"); 
            exit();
        }
		//need to get election title from form
        $file = fopen("TestElection2.txt","a") or die("Oh No! Cannot open file!");

        fwrite($file, serialize($_POST["options"]));
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
