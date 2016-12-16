<?php
require_once('auth_tutorial7.php');

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$mode = 'all';
//$mode = 'display';
//$mode = 'dump';
//$mode = 'get';
//$mode = 'metadata';
//$mode = 'set';
//$mode = 'raw';
//$mode = 'none';

try
{
    // page with no data definition
    $id = "e98efb3e8b7f08560139425c01f43ffb"; 
    $p  = $cascade->getAsset( a\Page::TYPE, $id );
    
    switch( $mode )
    {
        case 'all':
        case 'display':
            $p->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $p->dump( true );
            
            if( $mode != 'all' )
                break;
                
        case 'get':

            echo "Dumping the set of identifiers:" . BR;
            
            try
            {
                u\DebugUtility::dump( $p->getIdentifiers() );
            }
            catch( Exception $e )
            {
                u\DebugUtility::dump( $e->getMessage() );
            }

            if( $mode != 'all' )
                break;
                
        case 'set':
            $p->setXhtml( '<p>New content.</p>' )->
                edit()->dump( true );
            
            if( $mode != 'all' )
                break;
                
        case 'metadata':
            $m = $p->getMetadata();
            u\DebugUtility::dump( $m->getDynamicFieldNames() );

            if( $mode != 'all' )
                break;
                
        case 'raw':
            $p_std = $service->retrieve( $service->createId( 
                c\T::PAGE, $id ), c\P::PAGE );
                
            u\DebugUtility::dump( $p_std );
        
            if( $mode != 'all' )
                break;
    }
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