<?php
include 'db_config.php';

session_start();

$login_session = $_SESSION['login_user'];

echo'
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Course Report</title>

		<script src="https://kit.fontawesome.com/a076d05399.js"></script>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- startbootstrap.com -->
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

		<!-- Latest compiled javascript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
		<style>

			/* Style the list */
			ul.breadcrumb {
				overflow:hidden;
				width:100%;
			  background-color: #1d3056;
			  margin-top: 5%;
			}
			/* Display list items side by side */
			ul.breadcrumb li {
			  display: inline;
			  font-size: 18px;
			}
			/* Add a slash symbol (/) before/behind each list item */
			ul.breadcrumb li+li:before {
			  padding: 5px;
			  color: white;
			  content: "/\00a0";
			}
			/* Add a color to all links inside the list */
			ul.breadcrumb li a {
			  color: white;
			  text-decoration: none;
			}

			/* Add user button */
			.dropdowna {
			  padding: 15px 20px;

			}

			/* Glyphicon */
			.btn-group {
			  float: right;
			  position: relative;
			}
			.info {
			  padding: 20px 20px;
			}
			.headings {
			  background-color: #1d3056;
			  color: white;
			}

			/* Pagination */
			.pagination {
			  padding: 20px 20px;
			}
			.previous.disabled .page-link {
			  color: white;
			  background-color: #a6a6a6;
			  pointer-events: none;
			}
			.icon {
			  float: right;
			  position: relative;
			  padding: 50px 25px;
			  word-spacing: 15px;

			}

			.dropbtn {
			  background-color: #1d3056;
			  color: white;
			  font-size: 0px;
			  border: none;
			}

			.dropdown {
			  position: relative;
			  display: inline-block;
			}

			.dropdown-content {
			  display: none;
			  position: absolute;
			  background-color: #f1f1f1;
			  min-width: 160px;
			  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
			  z-index: 1;
			}

			.dropdown-content a {
			  color: black;
			  padding: 12px 16px;
			  text-decoration: none;
			  display: block;
			}

			.dropdown-content a:hover {background-color: #ddd;}

			.dropdown:hover .dropdown-content {display: block;}

			.dropdown:hover .dropbtn {background-color: #90774f;}

			.a{
				background: #90774f;
				color: white;
			}

		</style>
	</head>

	<body class="w3-light-grey">

	<!-- Top container -->
	<div class="w3-bar w3-top w3-small" style="z-index:4; background-color: #1d3056">
	  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();" style="float:left;"><i class="fa fa-bars"></i>  Menu</button>
	  <span class="w3-bar-item w3-animate-left" style="float: right;"><img src="sbfc.png"width=40%></span>
	</div>

	<!-- Sidebar/menu -->
	<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
	  <div class="w3-container w3-row">
	    <div class="w3-col s4">';


$sql = "SELECT FIRSTNAME,LASTNAME,PROFILE_IMG FROM account where USER_ID = ?";
mysqli_error($conn);
if($stmt = mysqli_prepare($conn, $sql))
    mysqli_stmt_bind_param($stmt, "s",$login_session);

if(mysqli_stmt_execute($stmt))
{
    $result = mysqli_stmt_get_result($stmt);
    while($row = mysqli_fetch_assoc($result))
    {
        if(!empty(base64_encode($row['PROFILE_IMG'])))
        {
            echo' <img src="data:image/jpeg;base64,'.base64_encode( $row['PROFILE_IMG'] ).'" class="w3-circle w3-margin-right" style="height:70px;width:70px;margin-top: 40px;">';
        }
        else{
            echo' <img src="assets/img/faces/face-9.jpg" class="w3-circle w3-margin-right" alt="image" style="height:70px;width:70px;margin-top: 40px;">';
        }
        echo'  </div>  <div class="w3-col s8 w3-bar">   <h4 style="padding-top: 40px;"> <span>Welcome, <strong><br>';
        echo $row['FIRSTNAME']." ".$row['LASTNAME'];
    }
}
else {
    echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
}


echo'</strong></span><br></h4>

	    </div>
	  </div>
	  <hr>

<div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <h4 style="font-size: 17px;background-color: #1d3056;color: #FFFFFF;"><a href="admin.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-pie-chart"></i>  Dashboard</a></h4>
    <h4 style="font-size: 17px;"><a href="admin-account.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw"></i>  Account</a></h4>
   <h4 style="font-size: 17px;"><a href="report.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-pie-chart"></i>  Analytics</a></h4>
   <h4 style="font-size: 17px;"> <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-comments"></i>  Messages</a></h4>
   <h4 style="font-size: 17px;"> <a href="logout.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-sign-out"></i>  Logout</a></h4>

  </div>
	</nav>


	<!-- Overlay effect when opening sidebar on small screens -->
	<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

	<!-- !PAGE CONTENT! -->

	<div class="w3-main" style="margin-left:300px;margin-top:43px;">

			<ul class="breadcrumb">
				<li><a href="admin.php">Home</a></li>
				<li style="font-size:25px;"><a href="#">Course Report</a></li>
			</ul>
		</div>';

echo '
<div id="chart" class="cht" style= "width:73% ; height: auto"></div>
<style>
				.cht{
					height:350px;
					width:1000px;
					margin-left:320px;
					margin-right:400px;
				
					background:white;
					-webkit-box-shadow: 7px 15px 104px -20px rgba(0,0,0,0.75);
					-moz-box-shadow: 7px 15px 104px -20px rgba(0,0,0,0.75);
					box-shadow: 7px 15px 104px -20px rgba(0,0,0,0.75);
				}
				</style>
				<br><br>
';

//cod for retrieving chart data
$r0 = "SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));";
 $r1= "SELECT  COURSE_ID, COUNT(COURSE_ID) FROM course_log GROUP BY COURSE_ID";
 $r2 = "SELECT COUNT(COURSE_ID) FROM course_log ";
 $res1=mysqli_query($conn,$r0);
 $res1=mysqli_query($conn,$r1);
 $res2=mysqli_query($conn,$r2);
 $row=mysqli_fetch_array($res2);
  $chart_data='';
  $yaxis='';
 while($row=mysqli_fetch_array($res1))
 {
 $ct=$row['COURSE_ID'];
 $ctr=$row['COUNT(COURSE_ID)'];
    $chart_data .="$ct,";
    $yaxis.="$ctr,";
 }
 var_export("[$yaxis]", true);
 var_export("[$chart_data]", true);
?>
<div class="container">
        <div class="ylabel"><p>Courses</p></div>
        <canvas id="line-chart" class="canvas"></canvas>
        <div class= "xlabel">Time</div>
        </div>
        <br><br><br><br>

<div class="trend">
<div class="yaxis"><p>USERS	</p></div>
<canvas id="myChart" class="canvas" ></canvas><br>
<div class="xaxis">COURSES</div>
</div>
<br><br><br><br>
        

<style>
  .canvas{
	margin-top:4%;
    height:400px !important;
	width:600px !important;
    flex-direction: row ;
    
    align-items: flex-start;
    flex-direction: row;
    flex-basis:80%;
  }
  .trend{
	margin-left: 335px;
          height: 67%;	
          margin-right: 1%;
            display: flex;
            flex-wrap: wrap;
            -webkit-box-shadow: -4px -16px 129px -30px rgba(0,0,0,0.75);
            -moz-box-shadow: -4px -16px 129px -30px rgba(0,0,0,0.75);
            box-shadow: -4px -16px 129px -30px rgba(0,0,0,0.75);
  }
.yaxis{
  padding: 200px 0px;
  
  font-size:20px;
  flex-direction: row;
  flex-wrap: wrap;
  flex-basis: 10%;
 
}
p{
  transform: rotate(-90deg);

}

.xaxis{
  
  
  width:60%;
  padding-left:500px;
  flex-direction: column;
  font-size:20px;
 
}
</style>
<script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
  
  type: 'bar',
  data: {
    labels: [<?php echo $chart_data;?>],
    datasets: [{
		label: '# course',
      data: [<?php echo $yaxis; ?>],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
	maintainAspectRatio: false,
	title: {
                      display: true,
                      text:'COURSES IN TREND',
                      fontSize:32,
                      
                  },
    scales: {
      xAxes: [{
        ticks: {
          maxRotation: 90,
          minRotation: 80
        }
      }],
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    }
  }
});
</script>
<?php
$rt0 = "SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));";
$rt1 = "SELECT CTIME, COUNT(DISTINCT USER_ID) FROM course_log WHERE DATE(CTIME)>= CURDATE() - INTERVAL 7 DAY  GROUP BY DATE(CTIME);";
$rt2 = "SELECT COUNT(DISTINCT USER_ID) FROM course_log WHERE DATE(CTIME)=CURDATE()";
 $rest1=mysqli_query($conn,$rt0);
 $rest1=mysqli_query($conn,$rt1);
 $rest2=mysqli_query($conn,$rt2);
    
   $rowt2=mysqli_fetch_array($rest2);
   $chart_data2='';
   $logt='';
      while($rowt=mysqli_fetch_array($rest1))
     {
        $timet= strtotime($rowt['CTIME']);
        $ctt=$rowt['COUNT(DISTINCT USER_ID)'];
    
        $logt .= " '".date('d-m-y',$timet)."', ";
        $chart_data2 .="$ctt,";
        }             
      var_export("[$chart_data2]", true);  
?>
  
        <style>
        .canvas{
			margin-top:4%;
   			 height:400px !important;
			width:500px !important;
   			 flex-direction: row ;
			padding-right:0px;
    		align-items: flex-end;
    		flex-direction: row;
    		flex-basis:80%;
          
          
        }
        
        .container{
			margin-right:10%;
			margin-left: 335px;
       		height: 67%;	
            display: flex;
            flex-wrap: wrap;
            -webkit-box-shadow: -4px -16px 129px -30px rgba(0,0,0,0.75);
            -moz-box-shadow: -4px -16px 129px -30px rgba(0,0,0,0.75);
            box-shadow: -4px -16px 129px -30px rgba(0,0,0,0.75);
            
          
        }
        
        .ylabel{
        
			padding: 200px 0px;
  			font-size:20px;
			flex-direction: row;
			flex-wrap: wrap;
			flex-basis: 10%;
         
        }
        .ylabel p{
          transform: rotate(-90deg);
          font-size: 20px;
        }
        .xlabel{
         
			
		padding-left:500px;
		flex-direction: column;
		font-size:20px;
        
        }
     
        
        </style>
      
     
         
       
            <script>
              new Chart(document.getElementById("line-chart"), {
                   type: "line",
                   data: {
                   labels: [<?php echo $logt; ?>],
                   datasets: [
                
                   {
                      data: [<?php echo $chart_data2;?>],
                      label: "Course",
                      borderColor: "#8e5ea2",
                      backgroundColor: "rgba(54, 162, 235, 0.2)",
                      fill: true,
                      
                   },
                  ],
                },
                options: {
              responsive: true,
              maintainAspectRatio: false,
             
                    title: {
                      display: true,
                      text:' COURSE COMPLETION CHART',
                      fontSize:32,
                      
                  },
                },
              });
            </script>

</body>
</html>