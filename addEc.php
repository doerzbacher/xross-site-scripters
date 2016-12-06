<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <head>
        <title>MUVE</title>
        <script>
            var i = 0;
            var j = 1;
            function makeRadioButton() {
                /**
                var radio = document.createElement('input');
                radio.type = "radio";
                radio.value = "0";
                radio.name = "entries[]";
                return radio; 
                **/ 
            }            

            function makeTextBox() {
                var text = document.createElement('input');
                text.type = "text";
                text.className = "form-control";
                text.placeholder = "Election Commissioner";
                text.name = "entries[" + (j - 1) + "][]";
                return text;
            }

            function makeDelButton(entryName) {
                var button = document.createElement('button');
                button.type = "button";
                button.className = "btn btn-danger";
                button.innerHTML = "x";
                button.onclick = function() {
                                    document.getElementById(entryName).remove();   
                                 }
                return button;
            }
    
            function makeNewEntry(q, k) {
                var a = document.createTextNode(q);
                document.body.appendChild(a);
                var list = document.getElementById(q);
                var entry = document.createElement('li');
                var div = document.createElement('div');
                var label = document.createElement('label');
                //var radio = makeRadioButton();
                var text = makeTextBox();
            
                entry.className = "list-group-item";
                entry.id = "entry"+i++;
                var delButton = makeDelButton(entry.id);
                div.className = "radio";
                //label.appendChild(radio);
                label.appendChild(text);
                label.appendChild(delButton);
                div.appendChild(label);
                entry.appendChild(div);
                entry.name = "entries[k][i]";
                list.insertBefore(entry, document.getElementById("createButton" + k));
            }
/**            
            function makeNewQuestion() {
                var loc = j;
                var space = document.getElementById('questionsSpace');
                var panelPrimary = document.createElement('div'); 
                panelPrimary.className = "panel panel-primary";
                var panelHead = document.createElement('div');
                panelHead.className = "panel-heading";
                var label = document.createElement('label');
                label.htmlfor = "ballotTitle"+j;
                label.innerHTML = "Enter a Title";
                var titleText = document.createElement('input');
                titleText.type = "text";
                titleText.id = "ballotTitle"+j;
                titleText.className = "form-control";
                titleText.placeholder = "Title";
                titleText.name = "entries["+j+"][0]";
                titleText.required = true;
                var panelBody = document.createElement('div');
                panelBody.className = "panel-body";
                var list = document.createElement('ul');
                list.className = "list-group";
                list.id = "entries" + j;
                var listItem1 = document.createElement('li');
                listItem1.className = "list-group-item";
                var radio = document.createElement('div');
                radio.className = "radio";
                var labelP = document.createElement('label');
                var radioIn = document.createElement('input');
                radioIn.type = "text";
                radioIn.className = "form-control";
                radioIn.placeholder = "Leave blank for write-in";
                radioIn.name = "entries["+j+"][1]"; 
                var listItem2 = document.createElement('li');
                listItem2.className = "list-group-item";
                listItem2.id = "createButton" + j;
                var button = document.createElement('button');
                button.type = "button";
                button.className = "btn btn-info";
                button.onclick = function() {
                                    makeNewEntry("entries" + (loc), loc);
                                 };
                button.innerHTML = "Add entry";

                panelHead.appendChild(label);
                panelHead.appendChild(titleText);
                labelP.appendChild(radioIn);
                radio.appendChild(labelP);
                listItem1.appendChild(radio);
                list.appendChild(listItem1);
                listItem2.appendChild(button);
                list.appendChild(listItem2);
                panelBody.appendChild(list);
                
                panelPrimary.appendChild(panelHead);
                panelPrimary.appendChild(panelBody);
                space.insertBefore(panelPrimary, document.getElementById("questionButton"));
                j++;
            }
   **/         
            function checkLoggedIn() {
                var username = localStorage.getItem("username");
                if (username === null) {
                    window.location.href = "login.html";
                }
                else if (username != "HSO"){
                    var closed = document.getElementById('closed');
                    var EC = document.getElementByIs('EC');
                    closed.style = "display: none";
                    EC.style = "display: none";
                }
                else if (username === "EC" || username === "HSO") {}
                else {
                    window.location.href = "noPermission.html";
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
    <body onload="form1.reset(); checkLoggedIn();">
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
                    <li class="nav-item" id="EC">
                        <a class="nav-link" href="addEc.php">Add EC</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="container">
            <form action="#" method="post" id="form1">
                <div class="top-words">
                    <h1>Morgantown University Voting Environment</h1>
                </div>
                <hr>
                <div class="row" id="creation">
                    <div class="col-md-4 col-md-offset-4" id="questionsSpace">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">List of Election Commissioners</h3>
                            </div>
                            <div class="panel-body">
                                <ul class="list-group" id="entries">
                                    <li class="list-group-item">
                                        <div class="radio">
                                            <label>
                                                <input type="text" class="form-control" placeholder="Election Commissioner" name="entries[0][1]" required>
                                            </label>
                                        </div>
                                    </li>
                                    <li class="list-group-item" id="createButton0">
                                        <button type="button" class="btn btn-info" onclick="makeNewEntry(&quot;entries&quot;, 0)">Add entry</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><!--creation-->
                <hr>
                <div class="text-center">
                    <button type="submit" class="btn btn-lg btn-default" style="margin-bottom: 5em">Submit</button>                 
                </div>
            </form>
        </div><!-- /.container -->
    </body>
</html>
