<?php
include "DB_Connect.php";

$sql="SELECT [Header].[Title],[Header].[Subtitle1],[Header].[Subtitle2],[Layouts].[ThemeCode]
            FROM [dbo].[Layouts]
            INNER JOIN [dbo].[Header]
            ON [Header].[HeaderId] = [Layouts].[HeaderId]
            WHERE [Layouts].[isSet] = 1";

$result = sqlsrv_query($conn, $sql);
if (sqlsrv_fetch($result) === false) {
    die(print_r(sqlsrv_errors(), true));
}
$headerTitle = sqlsrv_get_field($result, 0);
$subtitle1 = sqlsrv_get_field($result, 1);
$subtitle2 = sqlsrv_get_field($result, 2);
$cssFolder=sqlsrv_get_field($result, 3);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<link href='https://fonts.googleapis.com/css?family=Playfair Display' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Sacramento' rel='stylesheet'>

<link rel="stylesheet" type="text/css" href="<?php echo $cssFolder?>/common.css" />
<link rel="stylesheet" type="text/css" href="pagesCSS/Header.css" />
</head>
<body>	
	<div class="jumbotron jumbotron-fluid">
      <div class="container text-center">
        <h1 class="display-2" id="logo"><?php echo $headerTitle ?></h1>             
        <h1 class="display-6"><?php echo $subtitle1 ?></h1>        
        <p class="lead"><?php echo $subtitle2 ?></p>
      </div>
    </div>
	
	<nav class="navbar navbar1 navbar-expand-md navbar-toggleable-sm">
            <div class="container">             	        
                <!-- <button class="navbar-toggler collapsed custom-toggler" type="button" data-toggle="collapse" aria-controls="navbar1" aria-expanded="false" aria-label="Toggle navigation" data-target="#navbar1">
					<span class="navbar-toggler-icon"></span>
				</button> -->
                                
                <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbar1">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar1">
                	<div class="col-2"></div>
  					<div class="col-8">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="HomePage.php"> HOME </a> 
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="About.php"> ABOUT </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Gallery.php"> GALLERY </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Events.php"> EVENTS </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Booking.php"> BOOKING </a>
                            </li>                            
                        </ul>
                    </div>
                    <div class="col-2"></div>                    
                </div>
            </div>
        </nav>
</body>