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
//$mode = 'set';
//$mode = 'raw';

try
{
    $id  = "a14dd6578b7ffe830539acf0371e2f5f"; // Default
    $afc = $cascade->getAsset( a\AssetFactoryContainer::TYPE, $id )->dump();
    //$afc->setDescription( "Upload" )->edit()->dump();
    echo u\StringUtility::getCoalescedString( $afc->getDescription() ), BR;

    switch( $mode )
    {
        case 'all':
        case 'display':
            $afc->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $afc->dump( true );
            
            if( $mode != 'all' )
                break;

        case 'get':
            echo c\L::ID .            $afc->getId() . BR .
                 c\L::NAME .          $afc->getName() . BR .
                 c\L::PATH .          $afc->getPath() . BR .
                 c\L::PROPERTY_NAME . $afc->getPropertyName() . BR .
                 c\L::SITE_NAME .     $afc->getSiteName() . BR .
                 c\L::TYPE .          $afc->getType() . BR .
                 "";
                 
            $children = $afc->getChildren();
            
            foreach( $children as $child )
            {
                echo $child->getPathPath() . BR;
            }
            
            $container_children = $afc->getContainerChildrenIds();
            
            u\DebugUtility::dump( $container_children );
            
            if( $mode != 'all' )
                break;

        case 'set':
            $group_name = "cru";
            $group      = a\Asset::getAsset( 
                $service, a\Group::TYPE, $group_name );
          
            $afc->addGroup( $group )->edit();
             
            if( $afc->isApplicableToGroup( $group ) )
            {
                echo "Applicable to $group_name" . BR;
            }
            else
            {
                echo "Not applicable to $group_name" . BR;
            }
            
            echo $afc->getApplicableGroups() . BR;
          
            $afc->removeGroup( $group )->edit();
             
            if( $afc->isApplicableToGroup( $group ) )
            {
                echo "Applicable to $group_name" . BR;
            }
            else
            {
                echo "Not applicable to $group_name" . BR;
            }
                
            if( $mode != 'all' )
                break;
            
        case 'raw':
            $afc_std = $service->retrieve( 
                $service->createId( 
                    c\T::ASSETFACTORYCONTAINER, $id ), 
                    c\P::ASSETFACTORYCONTAINER );
            
            u\DebugUtility::dump( $afc_std );
            
            if( $mode != 'all' )
                break;
    }
    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\AssetFactoryContainer" );
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
