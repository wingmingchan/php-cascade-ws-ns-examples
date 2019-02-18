<?php
// url
$url = "http://mydomain.edu:1234/api/v1/read/page/formats/index?u=admin&p=admin";

$reply = apiOperation( $url );

if( $reply->success )
{
    echo "Successfully read the page";
    echo "<pre>";
    var_dump( $reply );
    echo "</pre>";
    
    // output h1
    echo $reply->asset->page->structuredData->structuredDataNodes[ 1 ]->
        structuredDataNodes[ 2 ]->text;
}
else
{
    echo "Failed to read the page.";
}

function apiOperation( $url )
{
    return json_decode( file_get_contents( $url ) );
}
?>