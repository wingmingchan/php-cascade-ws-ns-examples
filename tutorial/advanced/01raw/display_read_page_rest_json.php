<?php
// url
$url = "http://mydomain.edu:1234/api/v1/read/page/formats/index?u=admin&p=admin";

$reply = file_get_contents( $url );
var_dump( $reply );

$stdObj = json_decode( $reply );

if( $stdObj->success )
{
    echo "Successfully read the page";
    echo "<pre>";
    var_dump( $stdObj );
    echo "</pre>";
}
else
{
    echo "Failed to read the page.";
}
?>