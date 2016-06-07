<?php 
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$start_time = time();

try
{
    // to prevent time-out
    set_time_limit ( 10000 );
    // to prevent using up memory when traversing a large site
    ini_set( 'memory_limit', '2048M' );

    $results = array();
   
    // get all pages with a certain checkbox checked
    $cascade->getAsset( a\Folder::TYPE, 'a66686468b7f085601ed95548368a4dc' )->
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
    $end_time = time();
    echo "\nTotal time taken: " . ( $end_time - $start_time ) . " seconds\n";
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
    $end_time = time();
    echo "\nTotal time taken: " . ( $end_time - $start_time ) . " seconds\n";
}
?>