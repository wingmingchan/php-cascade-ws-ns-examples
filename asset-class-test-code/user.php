<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

$mode = 'all';
//$mode = 'display';
//$mode = 'dump';
//$mode = 'get';
//$mode = 'set';
//$mode = 'raw';

try
{
    $id = 'chanw-test';
    $u  = $cascade->getAsset( a\User::TYPE, $id );
    
    switch( $mode )
    {
        case 'all':
        case 'display':
            $u->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $u->dump( true );
            
            if( $mode != 'all' )
                break;
                
        case 'get':
            echo "Username: " . $u->getUsername() . BR .
                "Full name: " . $u->getFullName() . BR;

            if( $mode != 'all' )
                break;
        
        case 'set':
            $g = $cascade->getAsset( a\Group::TYPE, 'demo' );
            $u->
                setFullName( 'Wing Ming Chan' )->
                setPassword( '************' )->
                setEmail( 'chanw' )->
                disable()->
                enable()->
                setDefaultGroup( $g )->
                setDefaultSite( 
                    $cascade->getAsset(
                        a\Site::TYPE,
                        'ede8ade68b7f08560139425c36d7307f' ) )->
                edit();
            //$u->joinGroup( $g );

            if( $mode != 'all' )
                break;
        
        case 'raw':            
            $user_id = 'chanw-test';
            $user_std = $service->retrieve( 
                $service->createId( c\T::USER, $user_id ), c\P::USER );
/*
            $user_std->password = "chanw-test";
            $asset->user = $user_std;
            $service->edit( $asset );
            
            if( !$service->isSuccessful() )
            {
                echo $service->getMessage();
            }
*/            
            echo S_PRE;
            var_dump( $user_std );
            echo E_PRE;
       
            if( $mode != 'all' )
                break;
    }
}
catch( \Exception $e )
{
    echo S_PRE . $e . E_PRE;
}
?>
