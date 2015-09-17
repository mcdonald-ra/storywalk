<?php // upload.php
echo <<<_END
<html><head><title>PHP Form Upload</title></head><body>
<form method='post' action='uploadtest.php' enctype='multipart/form-data'>
Select File: <input type='file' name='filename' size='10' />
<input type='submit' value='Upload' />
</form>
_END;

if ($_FILES)
{
echo "HOWDY\n\n\n<br><br>";

print_r($_FILES) or die("NOPE");

	$name = $_FILES['filename']['name'];
	move_uploaded_file($_FILES['filename']['tmp_name'], "../Box/latham/uploads/".$name);
	
}

$dir = dir("../Box/latham/uploads");

//List files in images directory
while (($file = $dir->read()) !== false)
{
echo "<a href='../Box/latham/uploads/" . $file . "'>".$file."</a><br />";
}

$dir->close();

echo "</body></html>";
?>
