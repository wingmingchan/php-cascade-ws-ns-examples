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
    $ct = $cascade->getAsset(
        a\ContentType::TYPE, "493176ce8b7ffe83164c9314b87d55c2" );
    
    // to add a region
    $ct->addInlineEditableField(
            'RWD', 'BANNER FULL WIDTH', NULL, "xhtml", NULL )->
        addInlineEditableField(
            'RWD', 'BOTTOM', NULL, "xhtml", NULL )->        
        edit();
    
    // to remove a region  
    $ct->removeInlineEditableField( "RWD;BANNER FULL WIDTH;NULL;xhtml;NULL" )->edit();
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