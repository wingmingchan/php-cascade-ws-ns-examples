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
    $site_name   = 'cascade-admin';
    // server path to folder
    $host        = "/server/www/";

    // store results
    $results = array();
    
    // collect all pages in Cascade
    $cascade
        ->getAsset( a\Folder::TYPE, "/", $site_name )
        ->getAssetTree()
        ->traverse( 
            array( 
                a\Page::TYPE => array( "assetTreeStoreAssetPath" )
            ), 
            NULL, 
            $results );

    echo S_H3, "Cascade Pages:", E_H3;
    u\DebugUtility::dump( $results );
    echo BR;
    
    $server_pages = array();
    processFolder( $site_name, $server_pages );
    
    echo S_H3, "Server Pages:", E_H3;
    u\DebugUtility::dump( $server_pages );
    echo BR;

    $difference = array();
    
    foreach( $server_pages as $page )
    {
        $page_path = substr( $page, strlen( $site_name ) + 1 ); // the slash
        $page_path = substr( $page_path, 0, -4 );  // remove site name and .php
        
        // compare the two and store the difference
        if( !in_array( $page_path, $results[ "assetTreeStoreAssetPath" ] ) )
        {
            $difference[] = $page_path;
        }
    }

    sort( $difference );

    echo S_H3, "Difference:", E_H3;
    u\DebugUtility::dump( $difference );
    echo BR;
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE;
}

function processFolder( $dir, &$array ) 
{
    global $host;
    
    if( is_dir( $host . $dir . "/" ) && $handle = opendir( $host . $dir . "/" ) ) 
    {
        while( false !== ( $file = readdir( $handle ) ) ) 
        {
            if( $file == '.' || $file == '..' ) 
            {
                continue;
            }
            else if( is_file( $host . $dir . "/" . $file ) ) 
            {
                $name    = $dir . "/" . $file;
                
                if( u\StringUtility::endsWith( $name, ".php" ) )
                {
                    $array[] = $name;
                }
            }
            else if( is_dir( $host . $dir . "/" . $file . "/" ) ) 
            {
                processFolder( $dir . "/" . $file, $array );
            }
        }
    }
}
?>