<?php
/*
In order to make this program work for multiple types,
I have to use variables for types and method names.
This is not very efficient if the assets are contained in the base folder.
They should be combined into one single traversal.
*/
$start_time = time();

require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    // change the site name
    $site_name = "cascade-admin";
    
    // depending on what types of assets to be examined,
    // declare enough variables
    $type1 = "ScriptFormat";
    $type2 = "MetadataSet";
    $type3 = "ContentType";
    $type4 = "TextBlock";
    // $type5 = "WorkflowDefinition";
    
    // namespace
    $ns       = "cascade_ws_asset\\";
    
    // match the types with the corresponding get asset tree methods defined in Site
    $type_method_map = array(
        $type1 => "getAssetTree",
        $type2 => "getRootMetadataSetContainerAssetTree",
        $type3 => "getRootContentTypeContainerAssetTree",
        $type4 => "getAssetTree",
    );
    
    $results   = array();
    
    // this is not very efficient
    // ScriptFormat and TextBlock should be examined in one traversal instead of 
    // separate traversal
    foreach( array_keys( $type_method_map ) as $type )
    {
        // create classnames with namespace
        $type_ns = $ns . $type;
        
        $cascade->getSite( $site_name )->{ $type_method_map[ $type ] }()->traverse(
            array(
                // for every type, add a line here
                // assetTreeReportOrphans already defined in global_functions.php
                $type_ns::TYPE => array( "assetTreeReportOrphans" ),
            ),
            NULL,
            $results
        );
    }

    u\DebugUtility::dump( $results );
    $end_time = time();
    echo "\nTotal time taken: " . ( $end_time - $start_time ) . " seconds\n";
}
catch( \Exception $e )
{
    echo $e;
    $end_time = time();
    echo "\nTotal time taken: " . ( $end_time - $start_time ) . " seconds\n";
}
?>