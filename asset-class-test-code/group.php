<?php
require_once('auth_tutorial7.php');

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

//$mode = 'all';
$mode = 'display';
$mode = 'dump';
//$mode = 'raw';

try
{
    $g  = $cascade->getAsset( a\Group::TYPE, "hr" );
    //$g->addUser( $cascade->getAsset( a\User::TYPE, 'chanw' ) )->edit()->dump();
    //$g->addUserName( 'chanw' )->edit()->dump();
    //$g->removeUserName( 'chanw' )->edit()->dump();
    //$g->removeUser( $cascade->getAsset( a\User::TYPE, 'chanw' ) )->edit()->dump();

    switch( $mode )
    {
        case 'all':
        case 'display':
            $g->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $g->dump( true );

            if( $mode != 'all' )
                break;
        
        case 'raw':
            $g_std = $service->retrieve( $service->createId( 
                c\T::GROUP, $id ), c\P::GROUP );
                
            u\DebugUtility::dump( $g_std );
       
            if( $mode != 'all' )
                break;
    }

    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\Group" );
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