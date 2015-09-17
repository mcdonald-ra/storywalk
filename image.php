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
move_uploaded_file($_FILES['filename']['tmp_name'],"http://blackhawk.cs.mercer.edu/Box/Latham/uploads/". $name);
}

$dir =dir("http://blackhawk.cs.mercer.edu/Box/Latham/uploads/");

while (($file = $dir->read()) !==false)
{
echo "<a href='http://blackhawk.cs.mercer.edu/Box/Latham/uploads/" . $file . "'>".$file."</a><br>";
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