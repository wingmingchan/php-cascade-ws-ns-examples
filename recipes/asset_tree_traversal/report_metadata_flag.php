<?php 
/*
This program uses a pre-defined global function to report
on pages in which a certain metadata field contains a certain value.
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
   
    // get all pages with a certain checkbox checked
    $cascade->getAsset( a\Folder::TYPE, '4a4fc2d38b7f085600ebf23e49dfc2fd' )->
        getAssetTree()->traverse(
            array( a\Page::TYPE => array( c\F::REPORT_METADATA_FLAG ) ), 
            array( c\F::REPORT_METADATA_FLAG => array(
                a\Page::TYPE => array( 'exclude-from-left' => 'Yes' ) ) ),
            $results );
            
    if( count( $results[ c\F::REPORT_METADATA_FLAG ][ a\Page::TYPE ] ) > 0 )
    {
        foreach( 
            $results[ c\F::REPORT_METADATA_FLAG ][ a\Page::TYPE ] as $child )
        {
            // get the page object
            // $page = $child->getAsset( $service );
            // do something with the page
            
            // just echo the ID
            echo $child->getId() . BR;
        }
    }
    else
    {
        echo "There are none." . BR;
    }
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