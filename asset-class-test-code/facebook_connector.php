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
    $id = "6fff073e8b7f085600ae2282a925c0d1"; // facebook
    $fc = $cascade->getAsset( a\FacebookConnector::TYPE, $id );

    switch( $mode )
    {
        case 'all':
        case 'display':
            $fc->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $fc->dump( true );
            
            if( $mode != 'all' )
                break;

        case 'get':
            echo "ID: " . $fc->getId() . BR .
                 "Name: " . $fc->getName() . BR .
                 "Path: " . $fc->getPath() . BR .
                 "Property name: " . $fc->getPropertyName() . BR .
                 "Site name: " . $fc->getSiteName() . BR .
                 "Type: " . $fc->getType() . BR .
                 "";
                 
            $ct_path = "_common:XML";
            
            if( $fc->hasContentType( $ct_path ) )
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

            $fc->setDestination( 
                a\Asset::getAsset( 
                    $service, a\Destination::TYPE,
                    '980c57e08b7f0856015997e42b380833' ) )->
                edit();
            echo $fc->getDestinationPath();

/*
            // existing content type, new config
            $fc->addContentTypeLink( 
                a\Asset::getAsset( 
                    $service, a\ContentType::TYPE,
                    'dd46b9bc8b7f085600a0fcdc2fdf8b99' ), 
                'Desktop' );
            // new content type
            $fc->addContentTypeLink( 
                a\Asset::getAsset( 
                    $service, a\ContentType::TYPE,
                    'bd6f4eaa8b7f0856002a5e117e02a456' ), 
                'Mobile' )->edit();
*/
/*
            $fc->removeContentTypeLink( 
                a\Asset::getAsset( 
                    $service, a\ContentType::TYPE,
                    'bd6f4eaa8b7f0856002a5e117e02a456' ) )->
                edit();
*/
            // case 1: page name only
            //$fc->setPageName( 'blah-page' )->setPrefix( '' )->edit();
            // case 2: tags only, exception
            //$fc->setPageName( '' )->setPrefix( 'prefix' )->edit();
            // case 3:  both
            //$fc->setPageName( 'all' )->setPrefix( 'two' )->edit();

            if( $mode != 'all' )
                break;

        case 'raw':
            $fc_std = $service->retrieve( 
                $service->createId( 
                    c\T::FACEBOOKCONNECTOR, $id ), 
                    c\P::FACEBOOKCONNECTOR );
            
            echo S_PRE;
            var_dump( $fc_std );
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
