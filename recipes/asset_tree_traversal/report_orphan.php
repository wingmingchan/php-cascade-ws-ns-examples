<?php 
/*
This program uses a pre-defined global function to report
on assets that have no relationships.
*/
require_once('auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$start_time = time();

try
{
    u\DebugUtility::setTimeSpaceLimits();
    
    $results = array();
   
   $cascade->getAsset( 
        a\Folder::TYPE, '2e4d3fd68b7f0856002a5e11e49eee14' )->
        getAssetTree()->
        traverse( 
            array( a\File::TYPE => array( c\F::REPORT_ORPHANS ) ), 
            NULL, 
            $results );
    
    u\DebugUtility::dump( $results );

    u\DebugUtility::outputDuration( $start_time );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
    u\DebugUtility::outputDuration( $start_time );
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE;
    u\DebugUtility::outputDuration( $start_time );
}
?>