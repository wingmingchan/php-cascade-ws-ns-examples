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
    $id  = "d45af16e8b7f08560139425c08afe3d2"; // test-index-content
    $ifb = $cascade->getAsset( a\IndexBlock::TYPE, $id );
    
    if( $ifb->isContent() ) echo "Type: " . c\T::CONTENTTYPEINDEX . BR;
    
    switch( $mode )
    {
        case 'all':
        case 'display':
            $ifb->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $ifb->dump( true );
            
            if( $mode != 'all' )
                break;
                
        case 'get':
            echo "ID: " . $ifb->getId() . BR .
                 "Type: " . $ifb->getIndexBlockType() . BR;

            if( $mode != 'all' )
                break;
             
        case 'set':
            $ifb->
                setContentType( 
                    $cascade->getAsset( 
                        a\ContentType::TYPE, 
                        '9bdfd8928b7f0856002a5e11732284e6' ) )->
                setAppendCallingPageData( true )->
                setIndexAccessRights( true )->
                setIndexBlocks( true )->
                setIndexFiles( true )->
                setIndexLinks( true )->
                setIndexPages( true )->
                setIndexRegularContent( true )->
                setIndexSystemMetadata( true )->
                setIndexUserInfo( true )->
                setIndexUserMetadata( true )->
                setIndexWorkflowInfo( true )->
                setPageXML( c\T::RENDERCURRENTPAGEONLY )->
                setMaxRenderedAssets( 50 )->
                setRenderingBehavior( c\T::HIERARCHY )->
                setSortMethod( c\T::LASTMODIFIEDDATE )->
                setSortOrder( c\T::DESCENDING )->
                edit()->dump( true );
        
            if( $mode != 'all' )
                break;
                
        case 'raw':
            $ifb = $service->retrieve( $service->createId( 
                c\T::INDEXBLOCK, $id ), c\P::INDEXBLOCK );
            echo S_PRE;
            var_dump( $ifb );
            echo E_PRE;
        
            if( $mode != 'all' )
                break;
    }
}
catch( \Exception $e )
{
    echo S_PRE. $e . E_PRE;
}
?>