<!DOCTYPE html>
<html>
	<link rel="stylesheet" href="bootstrap.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
	<head>
		<title>MUVE</title>

        <script>
            function hideButtons() {
                var bool = true;
                var i;
                for (i = 0; bool; i++) {
                    try {
                        var button = document.getElementById('closeBtn' + i);
                        button.style = "display: none";
                    }
                    catch(err) {
                        bool = false;
                    }
                }
            }

            function checkLoggedIn() {
                var username = localStorage.getItem("username");
                if (username === null) {
                    window.location.href = "login.html";
                }
                else if (username === "HSO" || username === "EC") {

                }
                else {
                    hideButtons();
                }
            }

        </script>
	</head>
	<style>
		body {
			font-family: "Raleway", sans-serif
			padding-top: 5rem;
		}
		.top-words {
			padding: 3rem 1.5rem;
			text-align: center;
		}
	</style>
	<body onload="checkLoggedIn();">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="banner"></div>
		<div>
			<nav class="navbar navbar-fixed-top navbar-custom">
				<a class="navbar-brand" href="frontPage.html">MUVE</a>
				<ul class="nav navbar-nav">
					<li class="nav-item active">
						<a class="nav-link" href="elections.php">Elections<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="candidates.html">Candidates</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="archives.php">Archives</a>
					</li>
                    <li class="nav-item">
                        <a class="nav-link" href="electionCreate.html">Create Election</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="closedElections.php">Closed Elections</a>
                    </li>
				</ul>
			</nav>
		</div>
		<div class="container">
			<div class="top-words">
				<h1>Morgantown University Voting Environment</h1>
				<p class="lead">Current Elections</p>
			</div>
			<hr>
			
			<?php
				if(is_file("election-data/closedElections.txt"))
				{
					$closedElections = unserialize(file_get_contents("election-data/closedElections.txt"));
				
					if(is_array($closedElections))
					{
						
/**						echo "<div class='col-md-3'>"
						echo "<div class='panel panel-primary'>"
						echo "<div class='panel-body'>"
						echo "<ul class='list-group'>"  **/
						$counter=0;
						foreach($closedElections["elections"] as $election)
						{
							if(is_file("election-data/{$election}.ballot"))
							{
								$electionBallot = unserialize(file_get_contents("election-data/{$election}.ballot"));
								if(is_array($electionBallot))
								{
									echo "<li class='list-group-item'>";
									echo "<form action='procElectionCountRequest.php' method='post'>";
									
									echo "<p>{$electionBallot['electDescription']}</p>";
									echo "<button type='submit' class='btn btn-primary btn-lg' name='selectedElection' value='{$electionBallot["title"]}'>Go to {$electionBallot["title"]} results page</button>";
									echo "</form>";
									echo "<form action='#' method='post'>";
									echo "<div class='text-right'>";
									echo "<button type='submit' class='btn btn-danger btn-md' id='closeBtn{$counter}' name='selectedElection' value='{$electionBallot["title"]}'>Certify {$electionBallot["title"]}</button>";
									echo "</div></form>";
                                    echo "<form action='#' method='post'>";
                                    echo "<div class='text-right'>";
                                    echo "<button type='submit' class='btn btn-danger btn-md' name='selectedElection' value='{$electionBallot["title"]}'>Results</button>";
                                    echo "</div></form>";
                                    
								}
							}
							$counter++;
						}
									
					} else {
						echo "<p>There are currently no active elections.</p><br>";
					}
				} else {
					echo "<p>There are currently no active elections.</p><br>";
				}
			?>
			
		</div><!-- /.container -->
	</body>
</html>
