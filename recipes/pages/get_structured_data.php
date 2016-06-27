<?php 
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $page = $cascade->getAsset( a\Page::TYPE, "beda1ad58b7f08ee7691912d9470a54f" );
    $sd   = $page->getStructuredData();
    
    u\DebugUtility::dump( $sd->toStdClass() );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>