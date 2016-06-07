<?php 
require_once('cascade_ws_ns/auth_sandbox.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name = 'web-service-tutorial';
    $page_name = 'test';
    $page      = $cascade->getAsset( a\Page::TYPE, $page_name, $site_name );
    
    $cascade->deleteAsset( $page );
    
    // no exception thrown here
    $cascade->deletePage( $page_name, $site_name );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
?>