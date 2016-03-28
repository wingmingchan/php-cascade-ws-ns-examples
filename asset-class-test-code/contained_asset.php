<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

$mode = 'all';
//$mode = 'rename';
//$mode = 'move';
//$mode = 'get';
//$mode = 'raw';

try
{
    switch( $mode )
    {
        case 'all':
        case 'rename':
            $id = '08e726778b7f08560139425ca408f28b';
            $p  = a\Asset::getAsset( $service, a\Page::TYPE, $id );
            $p->rename( 'test3' );

            // exception: site cannot be renamed/moved
            //$id = 'c0d1d68e8b7f0856002a5e11ca4e0419';
            //$s  = a\Asset::getAsset( $service, Site::TYPE, $id );
            //$s->rename( 'tuw_test_dev' );
            
            if( $mode != 'all' )
                break;

        case 'move':
            // moving Base Folder: exception
            //$id = '980a854e8b7f0856015997e463c84a37';
            //$bf = a\Asset::getAsset( $service, a\Folder::TYPE, $id );
            //$bf->move( a\Asset::getAsset( $service, a\Folder::TYPE, $id ) );
            
            $bf = a\Asset::getAsset( 
                $service, a\Folder::TYPE, '980a854e8b7f0856015997e463c84a37' );
            $test = a\Asset::getAsset( 
                $service, a\Folder::TYPE, 'b8bf838f8b7f0856002a5e11586fba90' );
            $test_21 = a\Asset::getAsset( 
                $service, a\Folder::TYPE, 'ff736a7a8b7f085600adcd8137563987' );

            // moving page test2
            $p = a\Asset::getAsset(
                $service, a\Page::TYPE, 'e98efb3e8b7f08560139425c01f43ffb' );
            // moving page into test
            if( $p->isInContainer( $bf ) )
                $p->move( $test, false );
            // moving page into Base Folder
            else
                $p->move( $bf, false );

            // moving folder test21 into test
            if( $test_21->isInContainer( $bf ) )
                $test_21->move( $test, false );
            // moving folder test21 into Base Folder
            else
                $test_21->move( $bf, false );
            
            if( $mode != 'all' )
                break;
               
        case 'get':
            // site: exception
            $id = 'ec1c64d38b7f0856002a5e11ce2319fa';
            $s  = a\Asset::getAsset( $service, a\Site::TYPE, $id );
            //var_dump( $s->getParentContainer() ); // exception

            // Base Folder
            $id = '980a854e8b7f0856015997e463c84a37';
            $bf = a\Asset::getAsset( $service, a\Folder::TYPE, $id );
            var_dump( $bf->getParentContainer() ); // NULL
            echo BR;

            // root metadata set container
            $id   = 'fd276a9e8b7f08560159f3f0d0b72bac';
            $rmsc = a\Asset::getAsset( $service, a\MetadataSetContainer::TYPE, $id );
            var_dump( $rmsc->getParentContainer() ); // NULL
            echo BR;

            // metadata set container
            $id   = '647db3ab8b7f085600ae2282d55a5b6d';
            $msc = a\Asset::getAsset( $service, a\MetadataSetContainer::TYPE, $id );
            $msc->getParentContainer()->display();

            // files
            $id = '2e4d3fd68b7f0856002a5e11e49eee14';
            $ff = a\Asset::getAsset( $service, a\Folder::TYPE, $id );
            $ff->getParentContainer()->display();

            // metadata set
            $id = '647e77e18b7f085600ae2282629d7ea0';
            $ms = a\Asset::getAsset( $service, a\MetadataSet::TYPE, $id );
            $ms->getParentContainer()->display();
    
            if( $mode != 'all' )
                break;
    
        case 'raw':
        
            if( $mode != 'all' )
                break;
    }
}
catch( \Exception $e )
{
    echo S_PRE . $e . E_PRE;
}
?>