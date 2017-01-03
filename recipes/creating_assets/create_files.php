<?php 
require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name     = 'web-service-tutorial';
    $images_folder = 
        $cascade->getAsset( a\Folder::TYPE, 'images', $site_name );
    $files_folder  = $cascade->getAsset( a\Folder::TYPE, 'files', $site_name );
    
    $css = array(
        "global.css" => "http://www.upstate.edu/assets/global.css",
        "2009-theme.css" => "http://www.upstate.edu/assets/2009-theme.css"
    );
    
    $images = array(
        "rwd-upstate-logo.jpg" => "http://www.upstate.edu/assets/images/rwd-upstate-logo.jpg",
        "hloa.jpg" => "http://www.upstate.edu/specialevents/images/hloa.jpg"
    );
    
    $global_css = $cascade->getFile( 'files/global.css', $site_name );
    $theme_css  = $cascade->getFile( 'files/2009-theme.css', $site_name );
    
    if( is_null( $global_css ) && is_null( $theme_css ) )
    {
        // create css
        foreach( $css as $file_name => $url )
        {
            $cascade->createFile( 
                $files_folder,            // parent
                $file_name,               // filename
                file_get_contents( $url ) // text
            );
        }
    }
    
    $logo = $cascade->getFile( 'images/rwd-upstate-logo.jpg', $site_name );
    $hloa = $cascade->getFile( 'images/hloa.jpg', $site_name );
    
    if( is_null( $logo ) && is_null( $hloa ) )
    {
        // create images
        foreach( $images as $file_name => $url )
        {
            $cascade->createFile( 
                $images_folder, 
                $file_name,
                "",                       // no text
                file_get_contents( $url ) // binary data
            );
        }
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE;
}
?>