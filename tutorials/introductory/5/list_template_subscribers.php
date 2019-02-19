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
    $template = $cascade->getAsset( a\Template::TYPE, "9fea1e1b8b7ffe83164c9314e13a3233" );
    $subscribers = $template->getSubscribers();
    
    if( count( $subscribers ) > 0 )
    {
        echo S_UL;
        
        foreach( $subscribers as $subsriber )
        {
             echo S_LI, $subsriber->getPathSiteName(), ": ", $subsriber->getPathPath(),
                 E_LI;
        }
        
        echo E_UL;
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