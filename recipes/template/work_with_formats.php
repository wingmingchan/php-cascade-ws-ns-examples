<?php 
require_once( 'auth_tutorial7.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $template = $cascade->getAsset(
        a\Template::TYPE, "1f240ae68b7ffe834c5fe91eea20ec68" );
        
    // test if a format is attached to a region
    $format = $template->getPageRegionFormat( "DEFAULT" );
    
    // if not, attach a format
    if( !$format )
    {
        $format = $cascade->getAsset(
            a\XsltFormat::TYPE, "fd27e3578b7f08560159f3f0ad3ce618" );
        $template->setPageRegionFormat( 'DEFAULT', $format )->edit();
        
        // detach the format
        // $template->setPageRegionFormat( 'DEFAULT' )->edit();
    }
    
    // attach template-level format
    $format = $template->getFormat();
    
    if( !$format )
    {
        $format = $cascade->getAsset(
            a\XsltFormat::TYPE, "a537934d8b7f0856002a5e116963ce63" );
        $template->setFormat( $format )->edit();
        
        // detach the format
        // $template->setFormat()->edit();
    }
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