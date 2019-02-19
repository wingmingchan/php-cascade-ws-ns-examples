<?php
$u = "admin";
$p = "admin";

// url
$url = "http://mydomain.edu:1234/api/v1/read/page/formats/index?u=$u&p=$p";
// read the page
$reply = json_decode( file_get_contents( $url ) );

// page read
if( $reply->success )
{
    // change the h1
    $reply->asset->page->structuredData->structuredDataNodes[ 1 ]->
        structuredDataNodes[ 2 ]->text = "Formats";
    $url = "http://mydomain.edu:1234/api/v1/edit?u=$u&p=$p";
    $reply = apiOperation( $url, array( 'asset' => $reply->asset ) );
    var_dump( $reply );
}

function apiOperation( $url, $params )
{
    return json_decode(
        file_get_contents(
            $url, 
            false, 
            stream_context_create(
                array( 
                    'http' => array(
                        'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
                        'method'  => 'POST',
                        'content' => json_encode( $params )
                    )
                )
            )
        )
    );
}
?>