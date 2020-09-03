<?php

include 'db_config.php';
//session_start();

include('session.php');
if(!isset($_SESSION['login_user'])){
    header("location: loginpage.php"); // Redirecting To Home Page
}

$login_session = $_SESSION['login_user'];

echo '


<!DOCTYPE html>
<html>
<head>
<title>Reports</title>

<meta charset="UTF-8">


<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="icon" type="image/png" href="assets/img/favicon.ico">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<style>
	*box
	{
		box-sizing: border-box;
	}


body {
  font-family:  Arial, Helvetica, sans-serif;
  padding: 0px;
  background: #FFFFFF;
overflow: hidden;

}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 800px) {
  .leftcolumn, .middlecolumn {
    width: 50%;
    padding: 0;
  }
}


.topnavx {
  overflow: hidden;
  background-color:  #1d3056;
width:100%;

}

.topnavx a {
  float: left;
  color:#FFFFFF;
  text-align: center;
  font-size: 17px;
  text-decoration:none;
   font-size:20px;
   padding-top:15px;
   padding-bottom:10px;
padding-left:10px;

}

.topnavx a:hover {
  background-color:;
   text-decoration:underline;
  color: white;
}

.topnavx a.active {
padding-top:8px;
  font-size:180%;
  color: white;
}


.leftcolumnm {
  float: left;
  margin-left: 10px;
width: 45%;
  background-color: ;
  padding-left: 20px;
}

.middlecolumnm {
  float: left;
  margin-left: 10px;
width: 45%;
  padding-left: 20px;
}

/* Clear floats after the columns */
.rowm:after {
  content: "";
  display: table;
  clear: both;
}
.cardm {
  background-color: white;
  padding: 0px;
  margin-top: 20px;
  border: solid 2px #d9d9d9;
  border-radius: 6px;

}

h2{font-size:20px;}
a{text-decoration:none;}

a{color: #1d3056;}

a:hover {
   text-decoration:none;
  color: #90774f;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 800px) {
  .leftcolumnm, .middlecolumnm {
    width: 95%;
padding-left: 2px;

  }
}



</style>
</head>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-small" style="z-index:4;background-color: #1d3056">
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
    <h4 style="font-size: 17px;"><a href="admin.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-pie-chart"></i>  Dashboard</a></h4>
    <h4 style="font-size: 17px;"><a href="admin-account.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw"></i>  Account</a></h4>
   <h4 style="font-size: 17px;background-color: #1d3056;color: #FFFFFF;"><a href="report.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-pie-chart"></i>  Analytics</a></h4>
   <h4 style="font-size: 17px;"> <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-comments"></i>  Messages</a></h4>
   <h4 style="font-size: 17px;"> <a href="logout.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-sign-out"></i>  Logout</a></h4>

  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->

<div class="w3-main" style="margin-left:300px;margin-top:43px;">

<div class="topnavx" style="margin-top: 5%">
  <a  class="active" href="#" style="text-decoration: none;">Reports</a>
</div>
</div>
<br><br>
';
//cod for retrieving chart data
$r0 = "SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));";
$r1= "SELECT LOGINTIME, COUNT(DISTINCT USER_ID) FROM user_log WHERE DATE(LOGINTIME)>= CURDATE() - INTERVAL 7 DAY  GROUP BY DATE(LOGINTIME);";
$r2 = "SELECT COUNT(DISTINCT USER_ID) FROM user_log WHERE DATE(LOGINTIME)=CURDATE()";
$res1=mysqli_query($conn,$r0);
$res1=mysqli_query($conn,$r1);
$res2=mysqli_query($conn,$r2);
$row2=mysqli_fetch_array($res2);
$chart_data='';
$log='';
     while($row=mysqli_fetch_array($res1))
    {
    $time= strtotime($row['LOGINTIME']);
    $ct=$row['COUNT(DISTINCT USER_ID)'];

  
    $log .= " '".date('d-m-y',$time)."', ";
    $chart_data .="$ct,";
    }
var_export("[$chart_data]", true);
var_export("[$log]",true);

//retrieving second chart of course completion
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
  //retrieving data for trend chart


  $tr0 = "SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));";
 $tr1= "SELECT  COURSE_ID, COUNT(COURSE_ID) FROM course_log GROUP BY COURSE_ID";
 $tr2 = "SELECT COUNT(COURSE_ID) FROM course_log ";
 $tres1=mysqli_query($conn,$tr0);
 $tres1=mysqli_query($conn,$tr1);
 $tres2=mysqli_query($conn,$tr2);
 $trow=mysqli_fetch_array($tres2);
  $chart_data3='';
  $yaxis='';
 while($trow=mysqli_fetch_array($tres1))
 {
 $tct=$trow['COURSE_ID'];
 $tctr=$trow['COUNT(COURSE_ID)'];
    $chart_data3 .="$tct,";
    $yaxis.="$tctr,";
 }
 var_export("[$yaxis]", true);
 var_export("[$chart_data3]", true);
?>

<div class="container">
  <div class="ylabel"><p>USERS AND COURSES</p></div>
  <canvas id="line-chart" class="canvas"></canvas>
  <div class= "xlabel">TIME</div>
  </div>
  <br><br>  
  <div class="cont">
  <div class="ylabel"><p>COURSES</p></div>
  <canvas id="line" class="canvas"></canvas>
  <div class= "xlabel">TIME</div>
  </div>
  <br><br>  
  <div class="ulog">
  <div class="ylabel"><p>COURSES</p></div>
  <canvas id="linelogin" class="canvas"></canvas>
  <div class= "xlabel">TIME</div>
  </div>
  <br><br>
  <div class="trend">
  <div class="yaxis"><p>USERS	</p></div>
  <canvas id="myChart" class="canvas" ></canvas><br>
  <div class="xaxis">COURSES</div>
  </div>

 <style>
 .trend{
  margin-left: 335px;
          height: 67%;	
          margin-right: 5%;
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
.yaxis p{
  transform: rotate(-90deg);
    font-size: 20px;
}

.xaxis{
  
  
  width:60%;
  padding-left:500px;
  flex-direction: column;
  font-size:20px;
 
}
  .canvas{
    height:400px !important;
      width:600px !important;
      flex-direction: row ;
      margin-top:2%;
      align-items: flex-start;
      flex-direction: row;
      flex-basis:80%;
    
    
  }
  
  .container{
    margin-left: 335px;
          height: 67%;	
          margin-right: 5%;
            display: flex;
            flex-wrap: wrap;
            -webkit-box-shadow: -4px -16px 129px -30px rgba(0,0,0,0.75);
-moz-box-shadow: -4px -16px 129px -30px rgba(0,0,0,0.75);
box-shadow: -4px -16px 129px -30px rgba(0,0,0,0.75);
      
    
  }
  .cont{
    margin-left: 335px;
          height: 67%;	
          margin-right: 5%;
            display: flex;
            flex-wrap: wrap;
            -webkit-box-shadow: -4px -16px 129px -30px rgba(0,0,0,0.75);
-moz-box-shadow: -4px -16px 129px -30px rgba(0,0,0,0.75);
box-shadow: -4px -16px 129px -30px rgba(0,0,0,0.75);
      
  }
  .ylabel{
  
   padding: 190px 0px;
   
   flex-direction: column;
   padding-bottom:40px;
   flex-basis: 15%;
  flex-wrap: wrap; 
   
  }
  .ylabel p{
    transform: rotate(-90deg);
    font-size: 20px;
  }
  .xlabel{
   
    flex-direction: column;
    justify-content:flex-end;
    flex:3;
    align-self:flex-end;
    margin-right:;
    padding-left:70px;
   text-align:center;
   font-size: 20px;	
   margin-bottom:1%;
  
  }
 .ulog{
  margin-left: 335px;
          height: 67%;	
          margin-right: 5%;
            display: flex;
            flex-wrap: wrap;
            -webkit-box-shadow: -4px -16px 129px -30px rgba(0,0,0,0.75);
-moz-box-shadow: -4px -16px 129px -30px rgba(0,0,0,0.75);
box-shadow: -4px -16px 129px -30px rgba(0,0,0,0.75);
 }
  
  </style>
  <script>
              new Chart(document.getElementById("line-chart"), {
                   type: "line",
                   data: {
                   labels: [<?php echo $log; ?>],
                   datasets: [
                   {
                      data: [<?php echo $chart_data2;?>],
                      label: "Courses",
                      borderColor: "#90774f",
                      backgroundColor: "hsla(37, 97%, 50%, 0.52)",
                      showLine: true,
                      fill: true,
                      order: 2,
                   },
                   {
                      data: [<?php echo $chart_data;?>],
                      label: "Users",
                      borderColor: "#1d3056",
                      backgroundColor: "hsla(220, 77%, 53%, 0.48)",
                      fill: true,
                      order: 1,
                   },
                  ],
                },
                options: {
              responsive: true,
              maintainAspectRatio: false,
                    title: {
                      display: true,
                      text: 'Total Login and Course Completed',
                      fontSize: 32,
                  },
                },
              });
            </script>

<script>
              new Chart(document.getElementById("line"), {
                   type: "line",
                   data: {
                   labels: [<?php echo $log; ?>],
                   datasets: [
                   {
                      data: [<?php echo $chart_data2;?>],
                      label: "Courses",
                      borderColor: "#90774f",
                      backgroundColor: "rgba(255, 206, 86, 0.2)",
                      showLine: true,
                      fill: true,
                   
                   },

                  ],
                },
                options: {
              responsive: true,
              maintainAspectRatio: false,
                    title: {
                      display: true,
                      text: ' COURSE COMPLETION',
                      fontSize: 32,
                  },
                },
              });
            </script>

<script>
              new Chart(document.getElementById("linelogin"), {
                   type: "line",
                   data: {
                   labels: [<?php echo $log; ?>],
                   datasets: [
                   {
                      data: [<?php echo $chart_data;?>],
                      label: "Users",
                      borderColor: "#90774f",
                      backgroundColor: "rgba(255, 99, 132, 0.2)",
                      showLine: true,
                      fill: true,
                   
                   },

                  ],
                },
                options: {
              responsive: true,
              maintainAspectRatio: false,
                    title: {
                      display: true,
                      text: ' USER LOGIN',
                      fontSize: 32,
                  },
                },
              });
            </script>

<script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
  
  type: 'bar',
  data: {
    labels: [<?php echo $chart_data3;?>],
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




</body>
</html>