
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{ 
	?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Admin manage Users</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="js/jquery-2.1.4.min.js"></script>
<!-- //jQuery -->
<!-- tables -->
<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<link rel="stylesheet" type="text/css" href="css/basictable.css" />
<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();

      $('#table-breakpoint').basictable({
        breakpoint: 768
      });

      $('#table-swap-axis').basictable({
        swapAxis: true
      });

      $('#table-force-off').basictable({
        forceResponsive: false
      });

      $('#table-no-resize').basictable({
        noResize: true
      });

      $('#table-two-axis').basictable();

      $('#table-max-height').basictable({
        tableWrapper: true
      });
    });
</script>

<style>
a:link {
  color : white;
}
  </style>

<!-- //tables -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" /> -->
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" /> -->

<!-- //lined-icons -->
</head> 
   <div class="page-container">

   <?php include('includes/sidebarmenu.php');?>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>

	<div class="page-container">
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
            <!--header start here-->
				<?php include('includes/header.php');?>
				     <div class="clearfix"> </div>	
				</div>
<!--heder end here-->
<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i><a href="manage-users1.php">File</a><i class="fa fa-angle-right"></i> <?php echo $fileName  ?> </li>
            </ol>
<div class="agile-grids">
                  
<?php
    $currentDirectory = getcwd();
    $uploadDirectory = "/upload/";
    $isshow = 0;
    $errors = []; // Store errors here

    $fileExtensionsAllowed = ['txt','csv']; // These will be the only file extensions allowed 
   
    $fileName = $_FILES['the_file']['name'];

    $fileSize = $_FILES['the_file']['size'];
    $fileTmpName  = $_FILES['the_file']['tmp_name'];
    $fileType = $_FILES['the_file']['type'];
    $a = explode('.',$fileName);
    $fileExtension = strtolower(end($a));
        $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tms";


$conn = new mysqli($servername, $username, $password, $dbname);
// echo $fileName ;
$sql = "INSERT INTO review (fl,flg)
VALUES ('$fileName' , '1')";

if ($conn->query($sql) === TRUE) {
    // echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
    if (isset($_POST['submit'])) {

      if (! in_array($fileExtension,$fileExtensionsAllowed)) {
        $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
      }

      if ($fileSize > 4000000) {
        $errors[] = "File exceeds maximum size (4MB)";
      }

      if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload) {
            echo "The file " . basename($fileName) . " has been uploaded";?>
            <script>
            //localStorage.setItem('email', '<?php echo $_SESSION['email'];?>');  
            localStorage.setItem('file', '<?php echo $fileName;?>');
            </script>
        <?php } else {
          echo "An error occurred. Please contact the administrator.";
        }
      } else {
        foreach ($errors as $error) {
          echo $error . "These are the errors" . "\n";
        }
      }

    }
 //header('Location: manage-users1.php');
?>
<div style="padding-left: 20%;padding-right:27%;">
<div class="card">
  <div class="card-body">
  <canvas id="myChart" style="width:100%;max-width:550px"></canvas>
    
  </div>
</div>
  </div>
      <!-- <div style="padding-left: 20%;padding-right:10%;">
          <canvas id="myChart" style="width:100%;max-width:550px"></canvas>
      </div> -->


				<!-- tables -->
        <button type="button" class="button"> <a href="dloadfile.php?path=./upload/<?php echo $fileName ?>" > Download Output file  </a>    </button>
				
				<div class="agile-tables">
					<div class="w3l-table-info">
					  <h2></h2>
					    <table id="table">
						<thead>
						  <tr>
							<th>Review</th>
							<th>Prediction</th>
						  </tr>
						</thead>
						<tbody id="par">

						</tbody>
					  </table>
					</div>
				  </table>

				
			</div>

      <script>
        const xhr = new XMLHttpRequest();
        var file = localStorage.getItem("file");
        
    xhr.open("POST", "http://127.0.0.1:5000/?file=" + file , true);
    xhr.getResponseHeader("Content-type", "application/json");
  
    xhr.onload = function() {
        const obj = JSON.parse(this.responseText);
        console.log(obj);
        var noTrue=0
        var noFalse=0
        var par = document.getElementById('par');
        for(i of obj)
        {
          if(i[1]=="'Truthful'")
            noTrue++
          else
            noFalse++
          console.log(i);
          var tr = document.createElement("tr");
          var td1 = document.createElement("td");
          var td2 = document.createElement("td");
          td1.appendChild(document.createTextNode(i[0]));
          td2.appendChild(document.createTextNode(i[1]));
          tr.appendChild(td1);
          tr.appendChild(td2);
          par.appendChild(tr);
        }


        var xValues = ["Truthful", "Deceptive"];
var yValues = [noTrue,noFalse];
var barColors = [
  "#b91d47",
  "#00aba9"
];

new Chart("myChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Detection of fake reviews in " + file 
    }
  }
});



    }

    xhr.send();
      </script>



<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">
    <!-- <form action="dloadfile.php" method="post"> -->
     
    <!-- <button type="button" class="button"> <a href="dloadfile.php?path=./upload/<?php echo $fileName ?>" > Download Output file  </a>    </button> -->
            <!-- <input type="submit" name="submit" value="Download Output File" class="button"> -->
    <!-- </form> -->
</div>
<!--inner block end here-->
<!--copy rights start here-->
<?php include('includes/footer.php');?>
<!--COPY rights end here-->
</div>
</div>
  <!--//content-inner-->
		<!--/sidebar-menu-->
	</div>
<!--js -->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   
<?php
include('includes/config.php');
$result = mysqli_query($conn,"SELECT * FROM sens");
?>
</body>
</html>
<?php } ?>
