<?php
	// $url =
	// 'fakereview/upload/abc.txt';

	// $file_name = 'abc.txt';

	// if (file_put_contents($file_name, file_get_contents($url)))
	// {
	// 	echo "File downloaded successfully";
	// }
	// else
	// {
	// 	echo "File downloading failed.";
	// }
?>

<?php

if(isset($_GET['path']))
{
//Read the filename
$filename = $_GET['path'];
//Check the file exists or not
if(file_exists($filename)) {

//Define header information
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: 0");
header('Content-Disposition: attachment; filename="'.basename($filename).'"');
header('Content-Length: ' . filesize($filename));
header('Pragma: public');

//Clear system output buffer
flush();

//Read the size of the file
readfile($filename);

//Terminate from the script
die();
}
else{
echo "File does not exist.";
}
}
else
echo "Filename is not defined."
?>
