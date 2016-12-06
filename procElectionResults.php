<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <head>
        <title>MUVE</title>

        <script>
            function loggedInCheck() {
                var a = localStorage.getItem("username");
                var list = document.getElementById('rightNav');
                var ul = document.getElementById('navUl');
                if (a != null) {
                    var username = document.createElement('span');
                    username.className = "nav navbar-text";
                    username.innerHTML = "Hello, " + a;
                    username.style = "color: #ffffff";
                    list.appendChild(username);
                    
                    var li = document.createElement('li');
                    li.className = "nav-item";
                    var logout = document.createElement('a');
                    logout.className = "nav-link";
                    logout.onclick = function() {
                                        localStorage.removeItem("username");
                                        window.location.reload();
                                     };
                    logout.innerHTML = "Logout";
                    li.appendChild(logout);
                    ul.appendChild(li);
                }
                else {
                    var login = document.createElement('a');
                    login.className = "nav-link";
                    login.href = "login.html"
                    login.innerHTML = "Login";
                    list.appendChild(login);
                }

                if (a != "HSO") {
                    var closed = document.getElementById('closed');
                    closed.style = "display: none";
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
    <body onload="loggedInCheck();">
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
                    <li class="nav-item" id="closed">
                        <a class="nav-link" href="closedElections.php">Closed Elections</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right" style="padding-right: 5rem" id="navUl">
                    <li class="nav-item" id="rightNav">
                    </li>
                </ul>
            </nav>
        </div>
		
		
		
        <div class="container">
            <div class="top-words">
                <h1>Morgantown University Voting Environment</h1>
                <p class="lead">Get involved.  Make a difference.<br>Make your voice heard and vote for what you care about.</p>
            </div>
            <hr>
			
			<?php
				$electionTitle = str_replace(" ", "-", $_POST["selectedElection"]);
			
				if(is_file("election-data/results/{$electionTitle}.results"))
				{
					$results = unserialize(file_get_contents("election-data/results/{$electionTitle}.results"));
				
					//echo serialize($results),"<br>";
					for($raceIt=0; $raceIt<=max(array_keys($results["entries"])); $raceIt++)
					{
						echo "<div class='col-md-5 col-md-offset-3'><div class='text-center'>";
						echo "<h3>{$results["entries"][$raceIt][0]}</h3></div>";
						
						for($entryIt=1; $entryIt<=max(array_keys($results["entries"][$raceIt])); $entryIt++)
						{
							echo "<div class='panel panel-primary'>";
								echo "<div class='panel-body'>";
									echo $results["entries"][$raceIt][$entryIt];
								echo "</div>";
								echo "<div class='panel-footer'>";
									echo $results["voteCount"][$raceIt][$entryIt-1]," votes";
								echo "</div>";
							echo "</div>";
						}
						echo "</div>";
					}
				}
			?>
            
                
            </div>
        </div><!-- /.container -->
    </body>
</html>

