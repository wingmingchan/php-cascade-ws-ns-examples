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
    
    // get the sites
    $sites   = $cascade->getSites();
    $results = array();

    // traverse every root asset factory container
    foreach( $sites as $site )
    {
        $site->getAsset( $service )->
            getRootAssetFactoryContainerAssetTree()->traverse(
                array( a\AssetFactory::TYPE => 
                    array( c\F::REPORT_FACTORY_GROUP ) ),
                array( c\F::REPORT_FACTORY_GROUP => 
                    array( 'site-name' => $site->getPathPath() ) ),
                $results
            );
    }

    // process the report
    $report = $results[ c\F::REPORT_FACTORY_GROUP ];

    foreach( $report as $site => $factory_group_array )
    {
        echo "<h2>$site</h2>\n<ul>\n";
    
        foreach( $factory_group_array as $factory => $groups ) 
        { 
            echo "<li>$factory: $groups</li>\n"; 
        }
        
        echo "</ul>\n";
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