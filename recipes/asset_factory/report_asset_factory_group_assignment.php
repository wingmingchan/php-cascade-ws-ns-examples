<?php 
$start_time = time();

require_once('auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

u\DebugUtility::setTimeSpaceLimits();

try
{
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