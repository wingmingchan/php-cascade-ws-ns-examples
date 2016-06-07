<?php
/*
This program is used to synch the one-region master site from one instance to
another instance.
*/
require_once('cascade_ws_ns/auth_dev_app.php');

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
    
    $source_site_name = '_common_assets';
    $target_site_name = '_common_assets';
    $exception_thrown = true; // strict or lenient mode
    
    // set source site
    $instances->setSourceSite( $source_site_name );
    
    // set target site
    $instances->setTargetSite( $target_site_name );
    
    // last run 2016/05/18
    $step = 1;
    
    switch( $step )
    {
        case 1: // 7
            $instances->updateDataDefinitionContainer();
            break;
        case 2: // 5
            $instances->updateMetadatasetContainer();
            break;
        case 3: // 29
            $instances->updateFolder( false, $source_cascade->getAsset( a\Folder::TYPE, '/', $source_site_name ) );
            break;
        case 4: // 23
            $instances->updateFormat( $source_cascade->getAsset( a\Folder::TYPE, 'formats', $source_site_name ) );
            break;
        case 5: // 13
            $instances->updatePageConfigurationSetContainer( $exception_thrown );
            break;
        case 6: // 6
            $instances->updateContentTypeContainer();
            break;
        case 7: // 78
            // watch out for site-block-indexing: blockXML
            // set to Render XHTML
            // there are also blocks in the formats folder
            $instances->updateBlock(
            	$source_cascade->getAsset( a\Folder::TYPE, 'blocks', $source_site_name ), $exception_thrown );
            //$instances->updateBlock(
            	//$source_cascade->getAsset( a\Folder::TYPE, 'formats', $source_site_name ), $exception_thrown );
            break;
        case 8: // 7
            $instances->updateTemplate( 
            	$source_cascade->getAsset( a\Folder::TYPE, 'templates', $source_site_name ), $exception_thrown );
            break;
        case 9: // 2
            $instances->updateWorkflowDefinitionContainer();
            break;
        case 10: // 1
            $instances->updateSiteDestinationContainer();
            break;
        case 11: // 2
            $instances->updateFile( 
                $source_cascade->getAsset( a\Folder::TYPE, '/', $source_site_name ), $exception_thrown );
            break;
        case 12: // 18
            $instances->updatePage( 
            	$source_cascade->getAsset( a\Folder::TYPE, '/', $source_site_name ), $exception_thrown );
            break;
        case 13: // 2
            $instances->updateReference( 
                $source_cascade->getAsset( a\Folder::TYPE, '/', $source_site_name ) );
            break;
        case 14: // 6
            $instances->updateSymlink( 
                $source_cascade->getAsset( a\Folder::TYPE, '/', $source_site_name ) );
            break;
        case 15: // 2
            $instances->updateAssetFactoryContainer( $exception_thrown );
            break;
        case 16: // 31
            u\DebugUtility::dump( $instances->reportMissingAssetsIn( c\T::SOURCE, a\Page::TYPE ) );
            break;
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
