<?php
/*
This program shows how to add a group to
an asset factory container and all its direct child asset factories.
*/
require_once('auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $afc = $cascade->getAsset( a\AssetFactoryContainer::TYPE, 
        "95769c868b7f08ee71339a16c74bfae5" );
    //$afc->addGroupName( "22q" )->edit();
    
    $afs = $afc->getChildren();
    
    if( count( $afs ) > 0 )
    {
        foreach( $afs as $af_child )
        {
            $af = $af_child->getAsset( $service );
            $af->addGroupName( "22q" )->edit();
        }
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