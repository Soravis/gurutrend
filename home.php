<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="utf-8">
    <title>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->
    <link href="bootstrap/assets/css/bootstrap.css" rel="stylesheet">
    <style>
      body { padding-top: 60px; /* 60px to make the container go all the way
      to the bottom of the topbar */ }
    </style>
    <link href="bootstrap/assets/css/bootstrap-responsive.css" rel="stylesheet">
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
      </script>
    <![endif]-->
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    <style>
    </style>
  </head>
  <body>
    <div class="navbar navbar-fixed-top navbar-inverse">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar">
            </span>
            <span class="icon-bar">
            </span>
            <span class="icon-bar">
            </span>
          </a>
          <a class="brand" href="#">
            ProblemME
          </a>
          <div class="nav-collapse">
            <ul class="nav">
              <li>
                <a href="home.php">
                  Home
                </a>
              </li>
              <li>
                <a href="about.html">
                  About
                </a>
              </li>
              <li>
                <a href="contact.html">
                  Contact
                </a>
              </li>
            </ul>
          </div>
          <form class="navbar-form pull-right">
            <input name="textinput1" type="email" placeholder="Email" class="span2">
            <input name="textinput2" type="password" placeholder="Password" class="span2">
            <button class="btn">
              Sign in
            </button>
          </form>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">
                Categories
              </li>
              <li>
              </li>
              <li class=""><a href="home.php">All</a></li>
	                  <li class=""><a href="home.php?categories=Animals">Animals</a></li>
			  <li class=""><a href="home.php?categories=Celebrities">Celebrities</a></li>
			  <li class=""><a href="home.php?categories=Education">Education</a></li>
			  <li class=""><a href="home.php?categories=Fashion">Fashion</a></li>
			  <li class=""><a href="home.php?categories=Fooddrink">Food & Drink</a></li>
			  <li class=""><a href="home.php?categories=Healthfitness">Health & Fitness</a></li>
			  <li class=""><a href="home.php?categories=Relationship">Relationship</a></li>  
			  <li class=""><a href="home.php?categoreis=Sciencenature">Science & Nature</a></li>
			  <li class=""><a href="home.php?categories=Sport">Sport</a></li>
			  <li class=""><a href="home.php?categories=Technology">Technology</a></li>
			  <li class=""><a href="home.php?categories=Travel">Travel</a></li>
            </ul>
          </div>
  <footer>
                                <p>© ProblemME 2013</p>
                        </footer>

        </div>
		<div class="span7">
		        <div>
			  <h1>
			    Recently Added Problems
			  </h1>
			  
                            <?php
			       $db = new SQLite3('problemME');
			       
			       if($_POST["name"] && $_POST["problem"]) {
			          $query = "insert into problem values(NULL,datetime(),'".$_POST["name"]."',0,'".$_POST["categories"]."','".$_POST["problem"]."',0)";
			          
			          $temp = $db->exec($query);
			          if(!$temp) echo("Error when updating database");
			       }
			       if($_GET["pID"] && $_GET["like"]) {
			          echo("found");
			          $query = 'update problem set like = like+1 where pID='.$_GET["pID"];
			          
			          $temp = $db->exec($query);
			          if(!$temp) echo("Error when updating database");
			       }
			       $query = 'select * from problem';
			       if($_GET["categories"]) $query = $query." where categories='".$_GET["categories"]."'";
			       $query = $query." order by time DESC";
                               $result = $db->query($query);
			       
                               if(!$result) {
			          echo("There is no problem in such category!");
			       } else {
                                 $ct = 0;
                                 echo("<table>");
			         while($row = $result->fetchArray()){
                                     $ct = $ct + 1;
                                     echo("<tr>");
                                     echo("<td><b>".$row[2]."</b>&nbsp;·&nbsp;".$row[5]."</td>");
                                     echo("</tr><tr><td colspan=10><i>".$row[1]." · Category · ".$row[4]." · ");
	                             echo("<a href='comment.php?pID=".$row[0]."'>Comment</a> · ");
	                             echo("<a href='home.php?like=1&pID=".$row[0]."'>Like</a>");
	                             echo("· </i><span class='badge badge-info'>".$row[6]."</span></td></tr>");
                                 }
                                 if($ct == 0) echo("There is currently no problem in this category!");
			       }
			       
			       
			       ?>
			  </table>
			</div>
			
		</div>
        <div class="span3">
          <div class="hero-unit">
            <div>
              <h1>
                Share Yours!
              </h1>
              <p>
                &nbsp;
              </p>
            </div>
            <form action="home.php" method="post">
              <div class="control-group">
              </div>
              <label for="name">
                Name
              </label>
              <div class="control-group">
                <input name="name" id="name">
              </div>
              <label for="categories">
                Categories
              </label>
              <div class="control-group">
                <select name="categories" id="categories">
				  <option value="Animals">Animals</option>
				  <option value="Celebrities">Celebrities</option>
				  <option value="Education">Education</option>
				  <option value="Fashion">Fashion</option>
				  <option value="Fooddrink">Food & Drink</option>
				  <option value="Healthfitness">Health & Fitness</option>
				  <option value="Relationship">Relationship</option>
				  <option value="Sciencenature">Science & Nature</option>
				  <option value="Sport">Sport</option>
				  <option value="Technology">Technology</option>
				  <option value="Travel">Travel</option>		  
                </select>
              </div>
              <label for="problem">
                Problems (max 140 chars):
              </label>
              <textarea name="problem" id="problem" maxlength="140"></textarea>
            
            <button class="btn btn-primary" type="submit">
              Submit
	    </button>
            <button class="btn" type="reset">
              Cancel
	    </button>
	    </form>
          </div>
          <hr>
          
        </div>
      </div>
    </div>

    <style>
      
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">
    </script>
    <script src="bootstrap/assets/js/bootstrap.js">
    </script>
    <script src="bootstrap/assets/js/jquery.js"></script>
    <script src="bootstrap/assets/js/bootstrap-transition.js"></script>
    <script src="bootstrap/assets/js/bootstrap-alert.js"></script>
    <script src="bootstrap/assets/js/bootstrap-modal.js"></script>
    <script src="bootstrap/assets/js/bootstrap-dropdown.js"></script>
    <script src="bootstrap/assets/js/bootstrap-scrollspy.js"></script>
    <script src="bootstrap/assets/js/bootstrap-tab.js"></script>
    <script src="bootstrap/assets/js/bootstrap-tooltip.js"></script>
    <script src="bootstrap/assets/js/bootstrap-popover.js"></script>
    <script src="bootstrap/assets/js/bootstrap-button.js"></script>
    <script src="bootstrap/assets/js/bootstrap-collapse.js"></script>
    <script src="bootstrap/assets/js/bootstrap-carousel.js"></script>
    <script src="bootstrap/assets/js/bootstrap-typeahead.js"></script>
  </body>
</html>
