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
    $site_name = "formats";
    $page_name = "index";
    
    $page = $cascade->getAsset( a\Page::TYPE, $page_name, $site_name );
    $audits = $cascade->getAudits( $page, "edit" );
    
    if( count( $audits ) > 0 )
        u\DebugUtility::dump( json_encode( $audits[ 0 ]->toStdClass() ) );
    
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