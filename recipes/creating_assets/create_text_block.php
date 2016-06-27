<?php 
require_once('cascade_ws_ns/auth_sandbox.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $site_name = 'web-service-tutorial';
    $url       = 'webapp.upstate.edu/web-service-tutorial';
    $parent_folder  =
                $cascade->getAsset( a\Folder::TYPE, 'blocks', $site_name );
    $code = "<!--#passthrough<?php $pagetitle = 'Faculty Listing';
require_once('faculty/script/faculty_utilities.php');
echo \$pagetitle;
?>#passthrough-->";

    $text_block_name = 'title';
    $text_block = $cascade->getTextBlock( 'blocks/' . $text_block_name, $site_name );
    
    if( is_null( $text_block ) )
    {
        $cascade->createTextBlock(
            $parent_folder,
            $text_block_name,
            $code );
    }

    $code = "<div id=\"logo\"></div>";

    $text_block_name = 'logo';
    $text_block = $cascade->getTextBlock( 'blocks/' . $text_block_name, $site_name );

    if( is_null( $text_block ) )
    {
        $cascade->createTextBlock(
            $parent_folder,
            $text_block_name,
            $code );
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
?>