<?php
/*
This program can be used to publish all pages of a site.
The program issues a publish command on every page, bypassing
smart publishing.
*/
require_once( 'auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $cascade->getSite( "cascade-admin" )->getAssetTree()->
        traverse(
            array( a\Page::TYPE => array( "assetTreePublish" ) )
        );
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