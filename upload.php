<!DOCTYPE html>
<html lang="en">
<head>
<script src="jquery-1.11.1.min.js"></script>
<script src="/path/to/jquery-image-blob.min.js"></script>


<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="myCSS.css" />
<title>Story Templates</title>

</head>
<body>

<div class="row">
<div class="large-12 columns">
<div class="nav-bar right">

</div>

<h1>Winnie the Pooh</h1>

<hr/>
</div>
</div>

<div class="row">
 
     
<div class="large-9 columns" role="content">
 
<article>
<h3>Written by <a href="#">Your name</a></h3>
<h3>Date</h3>
 
<div class="row">
<div class="large-6 columns">
<p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo,<br>
 chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong.<br>
 Eiusmod swine spare ribs reprehenderit culpa.</p>
<p>Boudin aliqua adipisicing rump corned beef. Nulla corned beef sunt ball tip, qui bresaola enim jowl.<br>
Capicola short ribs minim salami nulla nostrud pastrami.</p>
</div>


</div>
 
<p>Pork drumstick turkey fugiat. Tri-tip elit turducken pork chop in. Swine short ribs meatball<br>
 irure bacon nulla pork belly cupidatat meatloaf cow. Nulla corned beef sunt ball tip, qui bresaola<br>
 enim jowl. Capicola short ribs minim salami nulla nostrud pastrami. Nulla corned beef sunt ball tip,<br>
 qui bresaola enim jowl. Capicola short ribs minim salami nulla nostrud pastrami.</p>
 
<p>Pork drumstick turkey fugiat. Tri-tip elit turducken pork chop in. Swine short ribs meatball irure<br>
 bacon nulla pork belly cupidatat meatloaf cow. Nulla corned beef sunt ball tip, qui bresaola enim jowl.<br>
 Capicola short ribs minim salami nulla nostrud pastrami.</p>
 
</article>
 

 
<aside class="large-3 columns">
 
</div> 

 
<div class="panel">

</div>
</aside>
        
<footer class="row">
<div class="large-12 columns">

<div class="row">
<div class="large-6 columns">
<p>© Copyright no one at all. Go to town.</p>
</div>
<hr/>
<br>
<br>

<div class="large-6 columns">
 <?php


echo<<<_END


<div>

<form name="bgcolorForm">Choose a color: 
<select onChange="if(this.selectedIndex!=0)
document.bgColor=this.options[this.selectedIndex].value">
<option value="choose">    
<option value="FFFFCC">light yellow
<option value="CCFFFF">light blue
<option value="CCFFCC">light green
<option value="CCCCCC">gray
<option value="pink">pink

</select>
</form>
</div>
<br>
<br>

<form action='upload.php' method='post' enctype='multipart/form-data'>
    Select image to upload:<br>
<input type='file' name='filename' id='fileToUpload'>
<input type='submit' value='Upload Image' name='submit'>
</form>
<iframe id="hidden_target" name="hidden_target" style="display:none;"></iframe>


<br>
<br>

_END;




if ($_FILES){

$name = $_FILES['filename']['name'];
move_uploaded_file($_FILES['filename']['tmp_name'],"../../Box/Latham/uploads/". $name);
}

$dir =dir("../../Box/Latham/uploads/");

while (($file = $dir->read()) !==false)
{
echo "<a href='../../Box/Latham/uploads/" . $file . "'>".$file."</a><br>";
}

$dir->close();




/* // Bind to the change event of our file input
$("input[name='myFileSelect']").on("change", function(){

    // Get a reference to the fileList
    var files = !!this.files ? this.files : [];

    // If no files were selected, or no FileReader support, return
    if ( !files.length || !window.FileReader ) return;

    // Only proceed if the selected file is an image
    if ( /^image/.test( files[0].type ) ) {

        // Create a new instance of the FileReader
        var reader = new FileReader();

        // Read the local file as a DataURL
        reader.readAsDataURL( files[0] );

        // When loaded, set image data as background of page
        reader.onloadend = function(){

            $("html").css("background-image", "url(" + this.result + ")");

        }

    }

});​ */



/* echo "</body></html>"; */
?>         
</div>
</div>
</div>
</footer>



</body>
</html>












