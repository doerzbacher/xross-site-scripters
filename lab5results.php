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
                <td colspan="1" class="other">
                    <table>
                        <tr><td colspan="3" class="poll"><h1>Current Poll Results</h1></td></tr>
                        <?php
                            $fileContent = unserialize(file_get_contents("voteCount.txt"));
                            if(!is_array($fileContent))
                            {
                                $emptyArr = array(0,0,0,0,0);
                                $fileContent = array("dayVoteArr"=>$emptyArr);
                            }
                            $dayArr = array("Monday","Tuesday","Wednesday","Thursday","Friday");
                            $voteSum = array_sum($fileContent["dayVoteArr"]);
                            for($i=0; $i<count($fileContent["dayVoteArr"]) && $i<count($dayArr); $i++)
                            {
                                $val = $fileContent["dayVoteArr"][$i];
                                $day = $dayArr[$i];
                                $percentage = 0.0;
                                if($val > 0)
                                {
                                    $percentage = (floatval($val)/floatval($voteSum))*100.0;
                                }
                                printf("<tr><td class='poll'>{$day}</td><td class='poll'>%d / %d</td>",$val,$voteSum);
                                printf("<td class='poll'>%4.0f%%</td></tr>", $percentage);
                            }
                        ?>
                    </table>
                </td>    
            </tr>
        </table>

		<hr>
        <p>
            <textbody> created by: Matthew Gramlich, 9/23/2016</textbody>
        </p>
	

</body></html>
