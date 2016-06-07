<?php
$start_time = time();

require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as     a;
use cascade_ws_property as  p;
use cascade_ws_utility as   u;
use cascade_ws_exception as e;

try
{
    // to prevent time-out
    set_time_limit( 10000 );
    // to prevent using up memory when traversing a large site
    ini_set( 'memory_limit', '2048M' );
    
    $site_name   = 'cascade-admin';
    $folder_path = 'projects/web-services/oop/classes/asset-tree';
    $max         = 25;
    
    $results = $report->
        setRootContainer( 
            $cascade->getAsset( 
                a\Folder::TYPE, $folder_path, $site_name )
        )->reportMetadataWiredFields( $max );
        
    //u\DebugUtility::dump( $results );
        
    echo S_H2 . "Pages with Long Titles" . E_H2;
    u\DebugUtility::dump( $report->reportLongTitle() );
    
    echo S_H2 . "Pages with Long Display Names" . E_H2;
    u\DebugUtility::dump( $report->reportLongDisplayName() );
    
    echo S_H2 . "Pages with Authors" . E_H2;
    u\DebugUtility::dump( $report->reportHasAuthor() );
    
    echo S_H2 . "Pages with No Authors" . E_H2;
    u\DebugUtility::dump( $report->reportHasNoAuthor() );

    echo S_H2 . "Pages with No Summaries" . E_H2;
    u\DebugUtility::dump( $report->reportHasNoSummary() );
    
    echo S_H2 . "Folders with No End Dates" . E_H2;
    u\DebugUtility::dump( $report->reportHasNoEndDate( a\Folder::TYPE ) );
    
    echo S_H2 . "Folders with End Dates" . E_H2;
    u\DebugUtility::dump( $report->reportHasEndDate( a\Folder::TYPE ) );
        
    $results = $report->
        setRootContainer( 
            $cascade->getAsset( 
                a\Folder::TYPE, $folder_path, $site_name )
        )->reportMetadataWiredFields( $max, 'Global' );
        
    echo S_H2 . "Pages Containing 'Global' in Title" . E_H2;
    u\DebugUtility::dump( $report->reportTitleContains() );
    
    $results = $report->
        setRootContainer( 
            $cascade->getAsset( 
                a\Folder::TYPE, $folder_path, $site_name )
        )->reportMetadataWiredFields( $max, 'asset tree' );

    echo S_H2 . "Pages Containing 'asset tree' in Keywords" . E_H2;
    u\DebugUtility::dump( $report->reportKeywordsContains() );
    
    $results = $report->
        setRootContainer( 
            $cascade->getAsset( 
                a\Folder::TYPE, $folder_path, $site_name )
        )->reportMetadataWiredFields( $max, 'global functions' );

    echo S_H2 . "Pages Containing 'global functions' in Summary" . E_H2;
    u\DebugUtility::dump( $report->reportSummaryContains() );
    
    $date = new DateTime( '2016-05-17 00:00:00' );
    
    $results = $report->
        setRootContainer( 
            $cascade->getAsset( 
                a\Folder::TYPE, $folder_path, $site_name )
        )->reportDate( $date );
   
   	//u\DebugUtility::dump( $results );
   	
    echo S_H2 . "Pages with Earlier Start Date" . E_H2;
    u\DebugUtility::dump( $report->reportStartDateBefore() );
  	
    echo S_H2 . "Pages with Later Start Date" . E_H2;
    u\DebugUtility::dump( $report->reportStartDateAfter() );
    
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