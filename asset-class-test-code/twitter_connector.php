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
    $tc_name = 'test-twitter-connector';
    $tc      = $cascade->getTwitterConnector( 
        a\TwitterConnector::TYPE, $tc_name, 'cascade-admin' );
        
    if( !isset( $tc ) )
    {
        $tc = $cascade->createTwitterConnector(
            $cascade->getAsset( a\ConnectorContainer::TYPE, '980a826b8b7f0856015997e424411695' ),
            $tc_name,
            $cascade->getAsset( 
                a\Destination::TYPE, 
                '4a37ff4d8b7f085600ae2282113b40c5' ),
            'H',  // hash tag
            't',  // prefix
            $cascade->getAsset( 
                a\ContentType::TYPE, 
                'a00d531c8b7f0856011c5ec62b24292d' ),
            'RWD' // configuration
        );
    }
    switch( $mode )
    {
        case 'all':
        case 'display':
            $tc->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $tc->dump( true );
            
            if( $mode != 'all' )
                break;

        case 'get':
            echo "ID: " . $tc->getId() . BR .
                 "Name: " . $tc->getName() . BR .
                 "Path: " . $tc->getPath() . BR .
                 "Property name: " . $tc->getPropertyName() . BR .
                 "Site name: " . $tc->getSiteName() . BR .
                 "Type: " . $tc->getType() . BR .
                 "Prefix: " . $tc->getPrefix() . BR .              
                 "Hash tags: " . $tc->getHashTags() . BR .              
                 "Destination ID: " . $tc->getDestinationId() . BR .              
                 "Destination path: " . $tc->getDestinationPath() . BR .              
                 "";
            
            $ct_path = "_common:No Right Column";
            
            if( $tc->hasContentType( $ct_path ) )
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
/*
            $d = a\Asset::getAsset( 
                $service, 
                a\Destination::TYPE,
                '4a37ff4d8b7f085600ae2282113b40c5' );
            
            $tc->setDestination( $d )->edit();
            echo $tc->getDestinationPath();
*/
/*
            // existing content type, new config
            $tc->addContentTypeLink( 
                a\Asset::getAsset( 
                    $service, 
                    a\ContentType::TYPE,
                    'dd46b9bc8b7f085600a0fcdc2fdf8b99' ), 
                'Desktop' );
            // new content type
            $tc->addContentTypeLink( 
                a\Asset::getAsset( 
                    $service, 
                    a\ContentType::TYPE,
                    'bd6f4eaa8b7f0856002a5e117e02a456' ), 
                'Mobile' )->edit();
*/

            $tc->removeContentTypeLink( 
                a\Asset::getAsset( 
                    $service, 
                    a\ContentType::TYPE,
                    'bd6f4eaa8b7f0856002a5e117e02a456' ) )->
                edit();

            // case 1: both empty
            //$tc->setHashTags( '' )->setPrefix( '' )->edit();
            // case 2: tags only
            //$tc->setHashTags( 'this' )->setPrefix( '' )->edit();
            // case 3: prefix only
            //$tc->setHashTags( '' )->setPrefix( 'one' )->edit();
            // case 4:  both
            //$tc->setHashTags( 'all' )->setPrefix( 'two' )->edit();

            if( $mode != 'all' )
                break;

        case 'raw':
            $tc_std = $service->retrieve( 
                $service->createId( 
                    c\T::TWITTERCONNECTOR, '03276c068b7f08560150c2965239b3ee' ), 
                    c\P::TWITTERCONNECTOR );
            
            echo S_PRE;
            var_dump( $tc_std );
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
