<!DOCTYPE html>
<html>
	<link rel="stylesheet" href="bootstrap.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
	<head>
		<title>MUVE</title>
        <script>
            function loggedInCheck() {
                var a = localStorage.getItem("username");
                if (a != "HSO") {
                    var closed = document.getElementById('closed');
                    var EC = document.getElementById('EC');
                    closed.style = "display: none";
                    EC.style = "display: none";
                }
            }
            function sendId() {
                var form = document.createElement('form');
                form.action = "elections.php";
                form.method = "post";
                form.style = "display: none;";
                var input = document.createElement('input');
                input.name = "userID";
                input.type = "text";
                input.readonly = true;
                var username = localStorage.getItem('username');
                input.value = username;
                form.appendChild(input);
                form.submit();
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
	<body>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="banner"></div>
		<div>
			<nav class="navbar navbar-fixed-top navbar-custom">
				<a class="navbar-brand" href="frontPage.html">MUVE</a>
				<ul class="nav navbar-nav">
					<li class="nav-item active">
						<a class="nav-link" onclick="sendId()">Elections<span class="sr-only">(current)</span></a>
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
                    <li class="nav-item" id="closed">
                        <a class="nav-link" href="closedElections.html">Closed Elections</a>
                    </li>
                    <li class="nav-item" id="EC">
                        <a class="nav-link" href="addEc.html">Add EC</a>
                    </li>
				</ul>
			</nav>
		</div>
		<div class="container">
			<div class="top-words">
				<h1>Morgantown University Voting Environment</h1>
				<p class="lead">Get involved.  Make a difference.<br>Make your voice heard and vote for what you care about.</p>
			</div>
			<?php
			
				if(is_file("election-data/certifiedElections.txt"))
				{
					$certifiedElections = unserialize(file_get_contents("election-data/certifiedElections.txt"));
					echo serialize($certifiedElections),"<br>";
					
					if(is_array($certifiedElections))
					{
						
/**						echo "<div class='col-md-3'>"
						echo "<div class='panel panel-primary'>"
						echo "<div class='panel-body'>"
						echo "<ul class='list-group'>"  **/
						$counter=0;
						foreach($certifiedElections["elections"] as $election)
						{
							if(is_file("election-data/{$election}.ballot"))
							{
								$electionBallot = unserialize(file_get_contents("election-data/{$election}.ballot"));
								if(is_array($electionBallot))
								{
									echo "<li class='list-group-item'>";
									echo "<form action='procElectionResults.php' method='post'>";
									echo "<p>{$electionBallot['electDescription']}</p>";
									echo "<button type='submit' class='btn btn-primary btn-lg' name='selectedElection' value='{$electionBallot["title"]}'>{$electionBallot["title"]} results page</button>";
									echo "</form>";
									echo "</li>";
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
			<hr>
		</div><!-- /.container -->
	</body>
</html>
