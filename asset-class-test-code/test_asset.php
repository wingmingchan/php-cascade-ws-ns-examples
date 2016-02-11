<?php 
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$mode = 'all';
//$mode = 'copy';
//$mode = 'display';
//$mode = 'dump';
//$mode = 'get';
//$mode = 'publishSubscribers';

try
{
    // test static method
    $page = a\Asset::getAsset( 
        $service, a\Page::TYPE, "2e9c6b1c8b7f0856002a5e11d46395d9" );

    switch( $mode )
    {
        case 'all':
        case 'copy':
            $page->copy(
                $cascade->getAsset( 
                    a\Folder::TYPE, "ffe39a278b7f08ee3e513744c5d70ead" ), // the target folder
                "test-asset" // new name
            );
            
            if( $mode != 'all' )
                break;
        
        case 'display':
            $page->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $page->dump( true );
            
            if( $mode != 'all' )
                break;

        case 'get':
            echo "Test getAudits", BR;
            $audits = $page->getAudits( c\T::EDIT );
            
            if( count( $audits) > 0 )
            {
                foreach( $audits as $audit )
                {
                    u\DebugUtility::dump( $audit->toStdClass() );
                }
            }
            
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
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>