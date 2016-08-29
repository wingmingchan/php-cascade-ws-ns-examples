<?php 
require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

//$mode = 'all';
//$mode = 'copy';
//$mode = 'display';
$mode = 'dump';
//$mode = 'edit';
$mode = 'getAudits';
//$mode = 'get';
//$mode = 'publishSubscribers';
//$mode = 'none';

try
{
    $page_id = "824b63c68b7ffe830539acf09bc3135b";
    
    // test static method
    $page = a\Asset::getAsset( 
        $service, a\Page::TYPE, $page_id );
        
    switch( $mode )
    {
        case 'all':
        case 'copy':
            $page->copy(
                $cascade->getAsset( 
                    a\Folder::TYPE, "3890a3f88b7ffe83164c931457a2709c" ), // the target folder
                "test-asset" // new name
            );
            
            if( $mode != 'all' )
                break;
        
        case 'display':
            $page->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $page->dump();
            
            if( $mode != 'all' )
                break;

        case 'edit':
            $page->setText( "main-content-content", "Test content" )->
                edit();
            
            if( $mode != 'all' )
                break;

        case 'getAudits':
            $audits = $page->getAudits();
            u\DebugUtility::dump( $audits );
            
            if( $mode != 'all' )
                break;

        case 'get':
            echo "Test get methods:", BR, 
                "getId: ", $page->getId(), BR;
            
            echo "getIdentifier:", BR;
            u\DebugUtility::dump( $page->getIdentifier() );
            
            // convert the stdClass identifier to an Identifier object
            $identifier = new p\Identifier( $page->getIdentifier(), $service );
            u\DebugUtility::dump( $identifier->toStdClass() );
            
            echo "getName: ", $page->getName(), BR,
                 "getPath: ", $page->getPath(), BR;
        
            echo "getProperty:", BR;
            u\DebugUtility::dump( $page->getProperty() );
            
            echo "getPropertyName:", $page->getPropertyName(), BR;
            
            echo "getService:", BR;
            u\DebugUtility::dump( $page->getService() );
            
            echo "getSiteId: ", $page->getSiteId(), BR,
                 "getSiteName: ", $page->getSiteName(), BR;

            echo "getSubscribers: ";
            $subscribers = $page->getSubscribers(); // array of Identifier objects
            
            echo "There are " . count( $subscribers ) . " subscribers.", BR;

            echo "getType: ", $page->getType(), BR;

            if( $mode != 'all' )
                break;
                
        case 'publishSubscribers':
            $page->publishSubscribers( 
                $cascade->getAsset( a\Destination::TYPE, "12bbbe2a8b7f0856002a5e11cdea7a3b" ) 
            );
            
            if( $mode != 'all' )
                break;
    }
    
    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\Asset" );
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