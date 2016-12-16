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
	$gc_id = '086439518b7ffe8339ce5d13b34124b6';
	$gc    = $cascade->getAsset( 
		a\GoogleAnalyticsConnector::TYPE, $gc_id );
	
    switch( $mode )
    {
        case 'all':
        case 'display':
            $gc->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $gc->dump( true );
            
            if( $mode != 'all' )
                break;

        case 'get':
            echo "ID: " .            $gc->getId() . BR .
                 "Name: " .          $gc->getName() . BR .
                 "Path: " .          $gc->getPath() . BR .
                 "Property name: " . $gc->getPropertyName() . BR .
                 "Site name: " .     $gc->getSiteName() . BR .
                 "Type: " .          $gc->getType() . BR .
                 "Base path: " .     $gc->getBasePath() . BR .              
                 "Profile ID: " .    $gc->getProfileId() . BR .              
                 "";
            
            $ct_path = "_common:No Right Column";
            
            // this connector has no content type
            if( $gc->hasContentType( $ct_path ) )
            {
                echo "The connector has content type: $ct_path." . BR;
            }
            else
            {
                echo "The connector does not " .
                    "have content type: $ct_path." . BR;
            }
            
            if( $mode != 'all' )
                break;

        case 'set':
            // case 1: both empty, exception
            //$gc->setBasePath( '' )->setProfileId( '' )->edit();
            // case 2: base path only, exception
            //$gc->setBasePath( 'this' )->setProfileId( '' )->edit();
            // case 3: profile id only
            //$gc->setBasePath( '' )->setProfileId( 'one' )->edit();
            // case 4:  both
            $gc->setBasePath( 'all' )->setProfileId( 'two' )->edit();

            if( $mode != 'all' )
                break;

        case 'raw':
            $gc_std = $service->retrieve( 
                $service->createId( 
                    c\T::GOOGLEANALYTICSCONNECTOR, $gc_id ), 
                    c\P::GOOGLEANALYTICSCONNECTOR );
            
            u\DebugUtility::dump( $gc_std );
            
            if( $mode != 'all' )
                break;
    }

    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\GoogleAnalyticsConnector" );
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