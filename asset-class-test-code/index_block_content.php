<?php
require_once('auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$mode = 'all';
//$mode = 'display';
//$mode = 'dump';
$mode = 'get';
//$mode = 'set';
//$mode = 'raw';

try
{
    $id  = "e975bf688b7f08ee4920cf1bf1aa508e"; // test-index-content
    $icb = $cascade->getAsset( a\IndexBlock::TYPE, $id );
    
    if( $icb->isContent() ) echo "Type: " . c\T::CONTENTTYPEINDEX . BR;
    
    switch( $mode )
    {
        case 'all':
        case 'display':
            $icb->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $icb->dump( true );
            
            if( $mode != 'all' )
                break;
                
        case 'get':
            echo "ID: " . $icb->getId() . BR .
                 "Type: " . $icb->getIndexBlockType() . BR .
                 "Indexed folder recycled: " . u\StringUtility::boolToString(
                     $icb->getIndexedFolderRecycled() ) . BR .
                 "Index files: " . u\StringUtility::boolToString(
                     $icb->getIndexFiles() ) . BR .
                 "Page xml: " . $icb->getPageXML() . BR .
                     "";
            $icb->getContentType()->dump();

            if( $mode != 'all' )
                break;
             
        case 'set':
            $icb->
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
            $icb = $service->retrieve( $service->createId( 
                c\T::INDEXBLOCK, $id ), c\P::INDEXBLOCK );
            echo S_PRE;
            var_dump( $icb );
            echo E_PRE;
        
            if( $mode != 'all' )
                break;
    }

    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\IndexBlock" );
}
catch( \Exception $e )
{
    echo S_PRE. $e . E_PRE;
}
catch( \Error $er ) 
{
    echo S_PRE . $er . E_PRE; 
} 
?>