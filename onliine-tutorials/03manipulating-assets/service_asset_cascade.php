<?php 
require_once( 'cascade_ws_ns/auth_chanw.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    // getting $service object through $cascade
    echo ( $cascade->getService() === $service ) ? "Same service object" : "Not the same", HR;
    
    // conversion between class objects and stdClass objects
    $type  = a\Page::TYPE;
    $path  = "test/velocity/test-calling-page";
    $site  = "cascade-admin";
    $id_st = "c916b2778b7f08ee5823686aff125245";
    
    // an stdClass object
    $id_stdClass = $service->createId( $type, $id_st );
    u\DebugUtility::dump( $id_stdClass );
    
    // Identifier, a Property object
    $identifier = new p\Identifier( $id_stdClass );
    u\DebugUtility::dump( $identifier );
    u\DebugUtility::dump( $identifier->toStdClass() );
    

    // 3 ways to create an Asset object
    // first way, use $cascade
    $page1 = $cascade->getAsset( $type, $path, $site );
    // second way, use use Child/Identifier and $service
    $page2 = $identifier->getAsset( $service );
    // third way, use constructor
    $page3 = new a\Page( $service, $id_stdClass );
    
    echo ( $page1->getId() === $page2->getId() ) ? "Same ID" : "Not the same", BR,
         ( $page2->getName() === $page3->getName() ) ? "Same name" : "Not the same", BR;

    // getting $service object through asset     
    echo ( $page1->getService() === $service ) ? "Same service object" : "Not the same", HR;
    
    // stdClass object
    u\DebugUtility::dump( $page1->getIdentifier() );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
?>