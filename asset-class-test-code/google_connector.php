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
	$gc_name = 'test-google-connector';
	$gc      = $cascade->getGoogleAnalyticsConnector( 
		a\GoogleAnalyticsConnector::TYPE, $gc_name, 'cascade-admin' );
	
	if( !isset( $gc ) )
	{
		$gc = $cascade->createGoogleAnalyticsConnector(
			$cascade->getAsset( a\ConnectorContainer::TYPE, '980a826b8b7f0856015997e424411695' ),
			$gc_name,
			'3836e8'
		);
	}

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
                    c\T::GOOGLEANALYTICSCONNECTOR, $gc_name, 'cascade-admin' ), 
                    c\P::GOOGLEANALYTICSCONNECTOR );
            
            echo S_PRE;
            var_dump( $gc_std );
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
