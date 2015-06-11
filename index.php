<?php
unlink('out.cer');
if (PHP_SAPI === 'cli') {
    $hostname = $argv[1];
    $port = $argv[2];
}
else {
    $hostname = $_GET['hostname'];
    $port = $_GET['port'];
    //$parts = parse_url($url);
    //parse_str($parts['hostname'], $hostname);
    //parse_str($parts['port'], $port);
}
//echo $hostname;
//echo $port . "\n";

exec("./getcert.sh $hostname $port");
$file = 'out.cer';
if (file_exists($file) && !(PHP_SAPI === 'cli')) {
    if(false !== ($handler = fopen($file, 'r')))
        {
	    header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename='.basename($file));
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($file));
	    readfile($file);
            exit;

        }
}
echo "<h1>Content error</h1><p>The file does not exist!</p>";
?>
