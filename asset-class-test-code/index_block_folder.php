<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

//$mode = 'all';
//$mode = 'display';
//$mode = 'dump';
//$mode = 'get';
$mode = 'set';
//$mode = 'raw';
//$mode = 'none';

try
{
    $id = "5f45243f8b7f08ee76b12c41758ae016"; // left-menu
    $ifb  = $cascade->getAsset( a\IndexBlock::TYPE, $id );
    
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
            echo c\L::ID . $ifb->getId() . BR .
                 "Index type: " . $ifb->getIndexBlockType() . BR .
                 "Append calling page data: " . 
                     $ifb->getAppendCallingPageData() . BR .
                 "Depth of index: " . $ifb->getDepthOfIndex() . BR .
                 "Index access rights: " . $ifb->getIndexAccessRights() . BR .
                 "Index blocks: " . $ifb->getIndexBlocks() . BR .
                 "Indexed content type ID: " . 
                     $ifb->getIndexedContentTypeId() . BR .
                 "Indexed content type path: " . 
                     $ifb->getIndexedContentTypePath() . BR .
                 "Indexed folder ID: " . $ifb->getIndexedFolderId() . BR .
                 "Indexed folder path: " . $ifb->getIndexedFolderPath() . BR .
                 "Indexed folder recycled: " . 
                     $ifb->getIndexedFolderRecycled() . BR .
                 "Index files: " . $ifb->getIndexFiles() . BR .
                 "Index links: " . $ifb->getIndexLinks() . BR .
                 "Index pages: " . $ifb->getIndexPages() . BR .
                 "Index regular content: " . 
                     $ifb->getIndexRegularContent() . BR .
                 "Index system metadata: " . 
                     $ifb->getIndexSystemMetadata() . BR .
                 "Index user info: " . $ifb->getIndexUserInfo() . BR .
                 "Index user metadata: " . $ifb->getIndexUserMetadata() . BR .
                 "Index workflow info: " . $ifb->getIndexWorkflowInfo() . BR .
                 "Max rendered assets: " . $ifb->getMaxRenderedAssets() . BR .
                 "Page xml: " . $ifb->getPageXML() . BR .
                 "Rendering behavior: " . $ifb->getRenderingBehavior() . BR .
                 "Sort method: " . $ifb->getSortMethod() . BR .
                 "Sort order: " . $ifb->getSortOrder() . BR .
                 "Is content: " . $ifb->isContent() . BR .
                 "Is folder: " . $ifb->isFolder() . BR .
                 "";

            if( $mode != 'all' )
                break;
             
        case 'set':
            
            //$fid = '980d6d088b7f0856015997e451c5e052';
            //$folder = $cascade->getAsset( a\Folder::TYPE, $fid );
            
            $ifb->
            	//setAppendCallingPageData( true )->
                setDepthOfIndex( 3 )->
                /*
                setFolder( $folder )->
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
                */
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