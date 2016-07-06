<?php 
require_once( 'cascade_ws_ns/auth_chanw.php' );
//require_once( "cascade_api_adapters.php" );
//require_once( "cascade_velocity.php" );
//require_once( "java_lang.php" );
//require_once( "java_util.php" );
require_once( "org_jdom.php" );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$params =
<<<PARAMS_XML
                <params>
                    <param>-class-</param>
                    <param>h3</param>
                    <param>true</param>
                </params>

PARAMS_XML;

$scripts =
<<<SCRIPTS_XML
<scripts>
    <script>
        <path>site://_common_assets/formats/library/velocity/chanw_reflect_utilities</path>
        <macro>
            <name>chanwDisplayClassAPI</name>
            <loop>
-params-
            </loop>
        </macro>
    </script>
</scripts>
SCRIPTS_XML;

$references =
<<<REFERENCES_XHTML
<h2>References</h2>
<ul>
<li><a href="https://docs.oracle.com/javase/8/docs/api/java/lang/Object.html">java.lang.Object</a></li>
</ul>
REFERENCES_XHTML;

try
{
    $site_name     = "cascade-admin-dev";
    
    $script_folder_path = "/_cascade/blocks/script";
    $script_folder      = $cascade->getAsset( a\Folder::TYPE, $script_folder_path, $site_name );
    $master_block       = $cascade->getAsset( a\XmlBlock::TYPE, "6469bedf8b7f08ee226116ffd10edb4e" );
    
    $parent_folder = $cascade->getAsset( a\Folder::TYPE, $parent_folder_path, $site_name );
    $master_page   = $cascade->getAsset( a\Page::TYPE, "ad0f11c58b7f08ee5551f7fae27b6bae" );
    
    

    foreach( $data as $datum )
    {
        list( $page_name, $display_name, $h1, $block_name, $classes ) = $datum;
        
        // find the script block, create it if not existing
        $block_path_name = $script_folder_path . "/" . $block_name;
        $block           = $cascade->getXmlBlock( $block_path_name, $site_name );
        
        if( is_null( $block ) )
        {
            $block = $master_block->copy( $script_folder, $block_name );
        }
        
        $param_xml = "";
        
        foreach( $classes as $class )
        {
            $param_xml .= str_replace( "-class-", $class, $params );
        }
        
        $block_xml = str_replace( "-params-", $param_xml, $scripts );
        
        $block->setXml( $block_xml )->edit();
        
        // find the page, create it if not existing
        $page_path_name = $parent_folder_path . "/" . $page_name;
        $page           = $cascade->getPage( $page_path_name, $site_name );
                
        if( is_null( $page ) )
        {
            $page = $master_page->copy( $parent_folder, $page_name );
        }
        
        $page->getMetadata()->setDisplayName( $display_name )->
            setTitle( $display_name )->
            getHostAsset()->
            setText( "main-content-title", $h1 )->
            //setText( "main-content-content", $references )->
            setText( "main-content-content", "" )->
            setBlock( "post-title-chooser", $block )->
            edit();
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>