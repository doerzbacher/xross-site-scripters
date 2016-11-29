<html><head>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<title>Matt Gramlich Lab 4: PHP</title>
		<link rel="stylesheet" type="text/css" href="lab5stylesheet.css">
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
		
		<table>
            <?php include('lab5mainTableStart.php'); ?>
            <tr>
              	<td colspan="2" class="other">
                    <?php
                       $message = file_get_contents("motd.txt");
                       echo("<textbody class='genMsg'>" . $message . "</textbody>");     
                    ?>
                </td>
            </tr>
        </table>

		<hr>
        <p>
            <textbody> created by: Matthew Gramlich, 9/23/2016</textbody>
        </p>
	

</body></html>
