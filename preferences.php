<?php 
require_once('cascade_ws_ns/auth_sandbox.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

try
{
    // raw code
    $service->readPreferences();
    //u\DebugUtility::dump( $service->getPreferences() );
    
    // use the class directly
    $p = new a\Preference($service, $service->getPreferences() );
    //$p->setValue( a\Preference::ALLOW_FONT_FORMATTING, "on" );
    //$p->dump( true );
    echo $p->getValue( a\Preference::ALLOW_FONT_FORMATTING );

    // through Cascade
    $cascade->getPreference()->
        setValue( a\Preference::ALLOW_TEXT_FORMATTING, "on" )->
        setValue( a\Preference::ALLOW_FONT_FORMATTING, "on" )->
        setValue( a\Preference::ASSET_TREE_MODE, "fastest" )->
        dump( true );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
?>