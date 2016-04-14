<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

//$mode = 'all';
//$mode = 'display';
//$mode = 'dump';
//$mode = 'get';
//$mode = 'set';
//$mode = 'raw';

try
{
    //$id = "22q"; 
    $g  = $cascade->getAsset( a\Group::TYPE, "22q" );
    $g->addUser( $cascade->getAsset( a\User::TYPE, 'chanw' ) )->edit();

/*    
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
                
        case 'get':
            echo "ID: " . $g->getId() . BR;

            if( $mode != 'all' )
                break;
        
        case 'set':
            $g->
                //addUser( User::getAsset( $service, 'chanw-test' ) )->
                //removeUser( User::getAsset( $service, 'chanw-test' ) )->
                //setWysiwygAllowFontAssignment( true )->            
                //setWysiwygAllowFontFormatting( true )->            
                //setWysiwygAllowImageInsertion( true )->            
                //setWysiwygAllowTableInsertion( true )->            
                //setWysiwygAllowTextFormatting( true )->            
                //setWysiwygAllowViewSource( true )->            
                edit();

            if( $mode != 'all' )
                break;
        
        case 'raw':
            $g_std = $service->retrieve( $service->createId( 
                c\T::GROUP, $id ), c\P::GROUP );
                
            
            echo S_PRE;
            var_dump( $g_std );
            echo E_PRE;
       
            if( $mode != 'all' )
                break;
    }
*/
}
catch( \Exception $e )
{
    echo S_PRE . $e . E_PRE;
}
?>
