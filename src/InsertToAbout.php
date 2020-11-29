<!-- this file uploads an image for AboutImage and stores all data in About page table -->

<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Wizard Home Page</title>
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/Gallery.css" />
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="wizardCSS/wizard.css" />
</head>

<div class="body">
	<body>
		<div class="container">
			<br>
			<center>
				<img src="photo/logo.png" alt="logo"> <br />
				<br />
				<h1 style="text-align: center; color: #71db77;"> AboutPage Wizard </h1>

			</center>
			<div class="  text-white">

				<div style="background: #222222;">
					<div class="card-body p-5">

<?php
include "DB_Connect.php";
if (isset($_POST['submit'])) {
    $aboutme = $_POST["about"];
    $aboutTitle = $_POST["title"];
    $filename = $_FILES["fileToUpload"]["name"];
    $tempname = $_FILES["fileToUpload"]["tmp_name"];
    
    $target_dir = "photo/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    if (move_uploaded_file($tempname, $target_file)) {

        $aboutme = str_replace("'", "''", $aboutme);
        $aboutTitle = str_replace("'", "''", $aboutTitle);
        $filename = str_replace("'", "''", $filename);
        $sql = "INSERT INTO [dbo].[About]
           ([Title]
		   ,[Content]
           ,[AboutImage])
                
            SELECT '$aboutTitle' ,'$aboutme','$filename'";

        sqlsrv_query($conn, $sql);
        
        echo "<font color='green'>" . "About page is set." . "</font>";
        echo " <br /> <br />";
        header("Location: InsertToLayout.php");
    } else {
        echo "Sorry, there was an error uploading your file, try again!";
    }
}

?>
	<form name="myForm" method="POST" enctype="multipart/form-data"
		onchange="return file_validate()" >
		<h4>Upload an image for About page:</h4>
		<input type="file" id="file" name="fileToUpload" accept="image/*" value="  " /> <span
			style="color: red" id="error-file"></span>
		<!-- Image preview -->
		<br /> <br />
		<div id="imagePreview"></div>
		<br />

		<h4>About page title:</h4>
		<span style="color: red" id="error-title"></span>
		<textarea rows="2" cols="50"  name="title"></textarea>
		<br /> <br />

		<h4>About page content:</h4>
		<span style="color: red" id="error-content"></span>
		<textarea rows="15" cols="80"  name="about"></textarea>		
		<br /> <br /><br />
		
		<div>
		<center>
		<a class="next" href="InsertToHeaderFooter.php">&laquo; Previous</a>		
		<button class="next" type="submit" name="submit" onclick="return validateForm()">Next &raquo;</button>
		</center>
		</div>
		<br /> <br />
	</form>

<script>
function validateForm(){
	var file = document.forms["myForm"]["fileToUpload"].value;
	var title = document.forms["myForm"]["title"].value;
	var content = document.forms["myForm"]["about"].value;

	if (file.length<1) {
        document.getElementById('error-file').innerHTML = " Please select a file to upload *"
        return false;
         }
	if (file.length>100) {
        document.getElementById('error-file').innerHTML = " Please rename your file to less than 100 characters *"
        return false;
         } 
    if (title.length<1) {
        document.getElementById('error-title').innerHTML = " Please Enter a title *";
        return false;
         }else{
        	 document.getElementById('error-title').innerHTML ="";
         }
    if (title.length>50) {
        document.getElementById('error-title').innerHTML = " Title length should be less than 50 characters *";
        return false;
        }else{
       	 document.getElementById('error-title').innerHTML ="";
        }
    if (content.length<1) {
        document.getElementById('error-content').innerHTML = " Please Enter your bio *";      
        return false;
        }else{
       	 document.getElementById('error-content').innerHTML ="";
        }
    if (content.length>4000) {
        document.getElementById('error-content').innerHTML = " The Maximum number of characters for content is 4000 *";      
        return false;
        }else{
       	 document.getElementById('error-content').innerHTML ="";
        }
          
}
</script>
	<script type="text/javascript">
function file_validate()
{
	var valid = true;
	var file_name = "";
	var file_type = "";
	var file_size = "";
	var valid_size = 5*1000*1000;
	var file = document.getElementById("file");
	if(file.files.length != 0)
	{
		file_name = file.files[0].name;
		file_size = file.files[0].size;
		file_type = file.files[0].type;
		
		if(file_type!="image/png" && file_type!="image/jpeg" && file_type!="image/gif")
		{
			valid = false;
			document.getElementById('error-file').innerHTML = "* Only 'PNG', 'JPG/JPEG' and 'GIF' file type supported."
				file.value="";
				}
		if(file_size > valid_size)
		{
			valid = false;
			document.getElementById('error-file').innerHTML = "* File size should be upto 3MB.";
			file.value="";
		}
	}
	else
	{
		valid = false;
			// No Image preview  
	                document.getElementById('imagePreview').innerHTML = ""; 
	}
	if(valid==true)
	{
		// Image preview 
            if (file.files && file.files[0]) { 
                var reader = new FileReader(); 
                reader.onload = function(e) { 
                    document.getElementById( 
                        'imagePreview').innerHTML =  
                        	'<img style="width: 200px" src="' + e.target.result  
                        + '"/>'; 
                }; 
                  
                reader.readAsDataURL(file.files[0]); 
            } 
            document.getElementById('error-file').innerHTML = "";
		return true;
	}
}</script>
 </div>
				</div>
				<center>
					&copy;
					<script>document.write(new Date().getFullYear());</script>
					Copyright - 2WDK Team
				</center>
				<br />
				<div />
			</div>
	
</body>
</html>
