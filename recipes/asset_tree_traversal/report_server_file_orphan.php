<?php
require_once('auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try 
{
    // folder to check
    $folder_name = 'files';
    $site_name   = 'cascade-admin';
    // server path to folder
    $host        = "/server/www/$site_name/";

    // store results
    $results = array();
    
    $cascade
        ->getAsset( a\Folder::TYPE, $folder_name, $site_name )
        ->getAssetTree()
        ->traverse( 
            array( 
                a\File::TYPE =>   array( c\F::REPORT_ORPHANS )
            ), 
            NULL, 
            $results );

    echo S_H3, "Cascade Orphans:", E_H3;
    u\DebugUtility::dump( $results );
    echo BR;
    
    $server_files = array();
    processFolder( $folder_name, $server_files );
    
    echo S_H3, "Server Orphans:", E_H3;
    u\DebugUtility::dump( $server_files );
    echo BR;

    $difference = array();
    
    foreach( $server_files as $file )
    {
        // compare the two and store the difference
        if( !in_array( $file, $results[ c\F::REPORT_ORPHANS ][ "file" ] ) )
        {
            $difference[] = $file;
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
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE;
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
                $array[] = $name;
                //echo $name, BR;
            }
            else if( is_dir( $host . $dir . "/" . $file . "/" ) ) 
            {
                processFolder( $dir . "/" . $file, $array );
            }
        }
    }
}
?>