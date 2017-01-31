<?php
require_once( 'auth_chanw.php' );

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
    
    $mode = 'number';
    $mode = 'publishable';
    $mode = 'unpublishable';
    $mode = 'orphan';
    $mode = 'empty';
    $mode = 'mixed';
    $mode = 'contain';
    $mode = 'wired';
    $mode = 'dynamic';
    $mode = 'last';
    
    switch( $mode )
    {
        case 'number':
            // get number of assets
            $results = $report->
                setRootFolder( 
                    $cascade->getAsset( 
                        a\Folder::TYPE, 'edcomm/web/policies', 'imt-intra' )
                )->reportNumberOfAssets( 
                    array( a\Folder::TYPE, a\Page::TYPE, a\File::TYPE ) );
            echo S_H2 . "Number of Assets" . E_H2;
            u\DebugUtility::dump( $results );
            break;
    
        case 'publishable':
            // get publishable assets
            $results = $report->
                setRootFolder( 
                    $cascade->getAsset( 
                        a\Folder::TYPE, 'edcomm/web/policies', 'imt-intra' )
                )->reportPublishable();
            echo S_H2 . "Publishable Assets" . E_H2;
            u\DebugUtility::dump( $results );
            //break;

        case 'unpublishable':
            // get unpublishable assets
            $results = $report->
                setRootFolder( 
                    $cascade->getFolder( 
                        'how-to/blocks', 'cascade-admin-old' )
                )->reportPublishable( false );
            echo S_H2 . "Unpublishable Assets" . E_H2;
            u\DebugUtility::dump( $results );
            break;
    
        case 'orphan':
            // get orphaned images
            $results = $report->
                setRootFolder( 
                    $cascade->getFolder( 'images', 'cascade-admin' )
                )->reportOrphanFiles();
            echo S_H2 . "Orphaned Images" . E_H2;
            u\DebugUtility::dump( $results );
            break;
            
        case 'empty':
            $results = $report->
                setRootFolder( 
                    $cascade->getAsset( 
                        a\Folder::TYPE, 'edcomm/web/policies', 'imt-intra' )
                )->reportPageNodeEmptyValue( 
                    array( "main-content-title" ) // one single node
                );
            echo S_H2 . "Pages Matching Empty H1" . E_H2;
            u\DebugUtility::dump( $results ); // 29
    
            $results = $report->
                setRootFolder( 
                    $cascade->getAsset( 
                        a\Folder::TYPE, 'edcomm/web/policies', 'imt-intra' )
                )->reportPageNodeEmptyValue(
                    // two nodes
                    array( "main-content-title", 
                           "content-group;0;content-group-content" ),
                    false // conjunctive
                );
                
            echo S_H2 . "Pages Matching Empty H1 and Empty Node" . E_H2;
            u\DebugUtility::dump( $results ); // 29
    
            $results = $report->
                setRootFolder( 
                    $cascade->getAsset( 
                        a\Folder::TYPE, 'edcomm/web/policies', 'imt-intra' )
                )->reportPageNodeEmptyValue(
                    // two nodes
                    array( "main-content-title", 
                           "content-group;0;content-group-content" ),
                    true // disjunctive
                );
                
            echo S_H2 . "Pages Matching Empty H1 or Empty Node" . E_H2;
            u\DebugUtility::dump( $results ); // 61
            break;

        case 'mixed': // both empty string and substring
            $results = $report->
                setRootFolder( 
                    $cascade->getAsset( 
                        a\Folder::TYPE, 'edcomm/web/policies', 'imt-intra' )
                )->reportPageNodeContainsValue( 
                    array( array( "main-content-title" => "" ) ) // one single node
                );
                
            echo S_H2 . "Pages Matching Empty H1" . E_H2;
            u\DebugUtility::dump( $results ); // 29
    
            $results = $report->
                setRootFolder( 
                    $cascade->getAsset( 
                        a\Folder::TYPE, 'edcomm/web/policies', 'imt-intra' )
                )->reportPageNodeContainsValue(
                    array(
                        array( "main-content-title" => "" ), 
                        array( "main-content-content" => "Galleriffic" ) 
                    ),
                    false // conjunctive
                );
                
            echo S_H2 . "Pages Matching Empty H1 and Specific Text in Content" . E_H2;
            u\DebugUtility::dump( $results ); // 1

            $results = $report->
                setRootFolder( 
                    $cascade->getAsset( 
                        a\Folder::TYPE, 'edcomm/web/policies', 'imt-intra' )
                )->reportPageNodeContainsValue(
                    array(
                        array( "main-content-title" => "Code" ), 
                        array( "main-content-content" => "Policies" ) 
                    )
                    // disjunctive
                );
                
            echo S_H2 . "Pages Matching Empty H1 or Specific Text in Content" . E_H2;
            u\DebugUtility::dump( $results ); // 36
            break;
            
        case 'contain':
            // get page with title containing 'Block' and 'Data'
            $results = $report->
                setRootFolder( 
                    $cascade->getFolder( 
                        'web-services/api/asset-classes', 
                        'cascade-admin' )
                )->reportPageNodeContainsValue(
                    array( 
                        array( "main-content-title" => "Block" ), 
                        array( "main-content-title" => "Data" )
                    ), 
                    false ); // conjunctive
                    
            echo S_H2 . "Pages with Title Containing 'Block' and 'Data'" . E_H2;
            u\DebugUtility::dump( $results ); // 3

            // get page with title containing 'Asset' or 'Global'
            $results = $report->
                setRootFolder( 
                    $cascade->getFolder( 
                        'web-services/api/property-classes', 
                        'cascade-admin' )
                )->reportPageNodeContainsValue(
                    array( 
                        array( "main-content-title" => "Asset" ), 
                        array( "main-content-title" => "Global" )
                    )
                ); // disjunctive
                
            echo S_H2 . "Pages with Title Containing 'Asset' or 'Global'" . E_H2;
            u\DebugUtility::dump( $results ); // 4
          
            // get page with title containing 'Asset' and 'Global'
            $results = $report->
                setRootFolder( 
                    $cascade->getFolder( 
                        'web-services/api/property-classes', 
                        'cascade-admin' )
                )->reportPageNodeContainsValue(
                    array( 
                        array( "main-content-title" => "Asset" ), 
                        array( "main-content-title" => "Global" )
                    ), 
                    false ); // conjunctive
                    
            echo S_H2 . "Pages with Title Containing 'Asset' and 'Global'" . E_H2;
            u\DebugUtility::dump( $results ); // 0
            break;
            
        case 'wired':
            // get page with empty displayName
            $results = $report->
                setRootFolder( 
                    $cascade->getFolder( 
                        'edcomm/web', 'imt-intra' )
                )->reportPageFieldEmptyValue(
                    array( "displayName" ) );
                    
            echo S_H2 . "Pages with Empty Display Name" . E_H2;
            u\DebugUtility::dump( $results ); // 2
            
            // get page with empty displayName or title
            $results = $report->
                setRootFolder( 
                    $cascade->getFolder( 
                        'edcomm/web', 'imt-intra' )
                )->reportPageFieldEmptyValue(
                    array( "displayName", "title" ),
                    true); // disjunctive
                    
            echo S_H2 . "Pages with Empty Display Name or Title" . E_H2;
            u\DebugUtility::dump( $results ); // 3
            
            // get page with empty displayName and title
            $results = $report->
                setRootFolder( 
                    $cascade->getFolder( 
                        'edcomm/web', 'imt-intra' )
                )->reportPageFieldEmptyValue(
                    array( "displayName", "title" ),
                    false); // conjunctive
                    
            echo S_H2 . "Pages with Empty Display Name and Title" . E_H2;
            u\DebugUtility::dump( $results ); // 1
            
            // get page with empty summary
            $results = $report->
                setRootFolder( 
                    $cascade->getFolder( 
                        'edcomm/web', 'imt-intra' )
                )->reportPageFieldEmptyValue(
                    array( "summary" ) );
                    
            echo S_H2 . "Pages with Empty Summary" . E_H2;
            u\DebugUtility::dump( $results ); // 12
            break;
            
        case 'dynamic':
            // get page with empty dynamic field
            $results = $report->
                setRootFolder( 
                    $cascade->getFolder( 
                        'edcomm/web', 'imt-intra' )
                )->reportPageFieldEmptyValue(
                    array( "include-in-menubar" ) );
                    
            echo S_H2 . "Pages with Empty Dynamic Field" . E_H2;
            u\DebugUtility::dump( $results ); // 11

            // get page with empty dynamic fields
            $results = $report->
                setRootFolder( 
                    $cascade->getFolder( 
                        'edcomm/web', 'imt-intra' )
                )->reportPageFieldEmptyValue(
                    array( "include-in-menubar", "exclude-from-menu" ) ); // disjunctive
                    
            echo S_H2 . "Pages with One or Two Empty Dynamic Fields" . E_H2;
            u\DebugUtility::dump( $results ); // 12
        
            // get page with empty dynamic fields
            $results = $report->
                setRootFolder( 
                    $cascade->getFolder( 
                        'edcomm/web', 'imt-intra' )
                )->reportPageFieldEmptyValue(
                    array( "include-in-menubar", "exclude-from-menu" ),
                    false ); // conjunctive
                    
            echo S_H2 . "Pages with Two Empty Dynamic Fields" . E_H2;
            u\DebugUtility::dump( $results ); // 10
       
            // get page with dynamic fields associated with specific values
            $results = $report->
                setRootFolder( 
                    $cascade->getFolder( 
                        'edcomm/web', 'imt-intra' )
                )->reportPageFieldMatchesValue(
                    array( 
                        array( "include-in-menubar" => "Yes" ), 
                        array( "exclude-from-menu" => "Yes" )
                    ),
                    true ); // disjunctive
                    
            echo S_H2 . "Pages with Two Dynamic Fields with Values" . E_H2;
            u\DebugUtility::dump( $results ); // 2
            
            // get page with dynamic fields associated with specific values
            $results = $report->
                setRootFolder( 
                    $cascade->getFolder( 
                        'edcomm/web', 'imt-intra' )
                )->reportPageFieldMatchesValue(
                    array( 
                        array( "include-in-menubar" => "Yes" ), 
                        array( "exclude-from-menu" => "Yes" )
                    ),
                    false ); // conjunctive
                    
            echo S_H2 . "Pages with Two Dynamic Fields with Values" . E_H2;
            u\DebugUtility::dump( $results ); // 1
      
            // get page with multiple dynamic fields with various values
            $results = $report->
                setRootFolder( 
                    $cascade->getFolder( 
                        'edcomm/web', 'imt-intra' )
                )->reportPageFieldMatchesValue(
                    array(
                        array( "text" => "Text" ), // must be exact match
                        array( "exclude-from-menu" => "" ), // empty
                        array( "exclude-from-left" => "Yes" ), // specific value
                        array( "multiselect" => "That" ),
                        array( "multiselect" => "These" ),
                        array( "dropdown" => "One" ),
                        array( "radio" => "No" )
                    ),
                    false ); // conjunctive
                    
            echo S_H2 . "Pages with Multiple Dynamic Fields with Various Values" . E_H2;
            u\DebugUtility::dump( $results ); // 1
            
            // get page with both wired and dynamic fields
            $results = $report->
                setRootFolder( 
                    $cascade->getFolder( 
                        'edcomm/web', 'imt-intra' )
                )->reportPageFieldMatchesValue(
                    array(
                        array( "text" => "Text" ), // must be exact match
                        array( "summary" => "" )
                    ),
                    false ); // conjunctive
                    
            echo S_H2 . "Pages with Both Wired and Dynamic Fields" . E_H2;
            u\DebugUtility::dump( $results ); // 1
            
            break;
            
        case 'last':
            // get file/page modified in the last three days
            $results = $report->
                setRootFolder( 
                    $cascade->getFolder( 
                        'edcomm/web', 'imt-intra' )
                )->reportLast( 'LastModifiedDate', 3, c\T::FORWARD ); // modified last 3 days
            echo S_H2 . "Files/Pages Last Modified in the Last Three Days" . E_H2;
            u\DebugUtility::dump( $results );
            
            // get file/page published in the last 20 days
            $results = $report->
                setRootFolder( 
                    $cascade->getFolder( 
                        '/web-services', 'cascade-admin' )
                )->reportLast( 'lastPublishedDate', 20, c\T::FORWARD ); // published last 20 days
            echo S_H2 . "Files/Pages Last Published in the Last Twenty Days" . E_H2;
            u\DebugUtility::dump( $results );
            
            // stale file/page report
            $results = $report->
                setRootFolder( 
                    $cascade->getFolder( 
                        '/web-services', 'cascade-admin' )
                )->reportLast( 'LastModifiedDate', 61, c\T::BACKWARD ); // not touched in 60 days
            echo S_H2 . "Files/Pages Not Touched in the Last Sixty Days" . E_H2;
            u\DebugUtility::dump( $results );
            
            // file/page created 3 months ago or newer
            $results = $report->
                setRootFolder( 
                    $cascade->getFolder( 
                        '/web-services', 'cascade-admin' )
                )->reportLast( 'createdDate', 90, c\T::FORWARD ); // created last 90 days
                
            echo S_H2 . "Files/Pages Created in the Last Three Months" . E_H2;
            u\DebugUtility::dump( $results );

            break;
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