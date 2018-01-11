<?php
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name   = "about-test";
    $folder_name = "images";
    $file_name   = "fad1.jpg";
    $image_url   = "http://www.upstate.edu/healthcare/images/find-a-doc/fad1.jpg";
    $file        = $cascade->getFile( "$folder_name/$file_name", $site_name );

    if( isset( $file ) )
        $cascade->deleteAsset( $file );
    
    $file = $cascade->createFile(
        $cascade->getAsset( a\Folder::TYPE, $folder_name, $site_name ),
        $file_name,
        "",
        ( $service->isSoap() ?
            file_get_contents( $image_url ) : 
            u\StringUtility::binaryToCharArray( file_get_contents( $image_url ) )
        )
    )->dump();

    u\DebugUtility::dumpRESTCommands( $service );    
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE; 
}
?>