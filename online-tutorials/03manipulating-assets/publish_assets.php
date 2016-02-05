<?php 
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

$mode = "page"; // control flag

try
{
    $site_name = 'advocates';
    
    switch( $mode )
    {
        case "folder":
            // publish the folder
            $folder = $cascade->getFolder( '8c5585948b7f08ee50b7de86f325f849' );
            //$folder->publish();
            
            // publish individual child in a folder
            $children = $folder->getChildren();
            
            foreach( $children as $child )
            {
                $service->publish( $child->toStdClass() );
            }
            break;
            
        case "page":
            $cascade->getPage( 'de7587bf8b7f08560081f143d45c4747' )->publish();
            break;
                
        case "site":
            $site = $cascade->getSite( $site_name );
            $site->publish();
            break;
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
?>