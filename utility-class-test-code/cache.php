<?php 
require_once( 'auth_REST_SOAP.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $cache                = u\Cache::getInstance( $service );
    $template_id_stdClass = $service->createId( a\Template::TYPE, "1db71c3f8b7f08ee7df4e217fd764404" );
    $template_identifier  = new p\Child( $template_id_stdClass );

    // test cache time
    $start_time = time();
    
    for( $i = 0; $i < 50; $i++ )
    {
        $template = $cache->retrieveAsset( $template_identifier );
    }
    
    //$cache->displayCache();    // 0 seconds
    $cache->displayCacheKeys();  // 0 second
    
    $end_time = time();
    echo "\nTotal time taken when using cache: " . ( $end_time - $start_time ) .
        " seconds\n" . BR;
        
    //u\DebugUtility::dump( $cache );
    $cache->clearCache();
    
    $start_time = time();

    $template = $template_identifier->getAsset( $service );
    $cache->storeAsset( $template );
    
    for( $i = 0; $i < 50; $i++ )
    {
        $template = $cache->retrieveAsset( $template_identifier );
    }
    
    $end_time = time();
    echo "\nTotal time taken when using cache: " . ( $end_time - $start_time ) .
        " seconds\n" . BR;

    // test direct retrieval time
    $start_time = time();
    
    for( $i = 0; $i < 50; $i++ )
    {
        $template = $template_identifier->getAsset( $service );
    }
    
    $end_time = time();
    echo "\nTotal time taken without cache: " . ( $end_time - $start_time ) .
        " seconds\n" . BR; // 8 seconds
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