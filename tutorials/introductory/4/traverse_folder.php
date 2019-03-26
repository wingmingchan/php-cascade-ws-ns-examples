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
    $bf = $admin->getSite( "cascade-admin" )->getBaseFolder();
    traverseFolder( $bf );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE; 
}

function traverseFolder( a\Folder $f, bool $isRoot=true )
{
    if( $isRoot )
    {
        echo S_UL;
    }

    // output type and folder name
    echo S_LI, a\Folder::TYPE, ": ", $f->getName();
    
    $children = $f->getChildren();
    
    if( count( $children ) > 0 )
    {
        echo S_UL;
    
        foreach( $children as $child )
        {
            $type = $child->getType();
        
            if( $type == a\Folder::TYPE )
            {
                traverseFolder( $child->getAsset( $f->getService() ), false );
            }
            else
            {
                // output type and name
                echo S_LI, $type, ": ", $child->getPathPath(), E_LI;
            }
        }
    
        echo E_UL;
    }
    
    echo E_LI;
    
    if( $isRoot )
    {
        echo E_UL;
    }
}
?>