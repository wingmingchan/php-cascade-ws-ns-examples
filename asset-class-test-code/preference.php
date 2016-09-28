<?php
require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    // through Cascade
    $pref = $cascade->getPreference(); //->
        //setValue( a\Preference::ALLOW_TEXT_FORMATTING, "on" )->
        //setValue( a\Preference::ALLOW_FONT_FORMATTING, "on" )->
        //setValue( a\Preference::ASSET_TREE_MODE, "fastest" )->
        //dump();
        
    $pref->setValue( a\Preference::ALLOW_TABLE_EDITING, "on" );
    
    $pref->dump();
    
    echo $pref->getValue( a\Preference::ASSET_TREE_MODE );
    
    u\DebugUtility::dump( $pref->toStdClass() );
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