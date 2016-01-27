<?php 
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $mode      = 'page';
    $site_name = 'cascade-admin';
    
    switch( $mode )
    {
        case 'page':
            // unpublish a page using an stdClass identifier
            //$service->unpublish( 
                //$service->createIdWithPathSiteNameType( 'test33', $site_name, a\Page::TYPE ) );
        
            // unpublish a page using a Page object
            //$service->unpublish( 
                //$cascade->getAsset( a\Page::TYPE, 'test33', $site_name )->getIdentifier() );
        
            $cascade->getAsset( a\Page::TYPE, 'test33', $site_name )->unpublish();
            
            break;
            
        case 'file':
            $cascade->getAsset( a\File::TYPE, 'files/fellow_listing.xls', $site_name )->unpublish();
            
            break;
            
        case 'folder':
            $cascade->getAsset( a\Folder::TYPE, '78dd0fed8b7f08ee00f31cdbd8085d8a' )->unpublish();
            
            break;
    }
} 
catch( \Exception $e ) 
{ 
    echo S_PRE . $e . E_PRE; 
} 
?>