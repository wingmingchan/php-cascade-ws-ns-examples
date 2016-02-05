<?php
/*
This script is used to create pages, velocity formats,
and tie them together, to display database information.
*/
require_once('cascade_ws_ns/auth_sandbox.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

try
{
    $page_table = array(

        "asset-factory" => array( 
            "table"   => "cxml_assetfactory",
            "display" => "Asset Factory",
            "sql"     => "ASSET_FACTORY_SQL",
        ),
        "asset-factory-container" => array( 
            "table"   => "cxml_assetfactorycontainer",
            "display" => "Asset Factory Container",
            "sql"     => "ASSET_FACTORY_CONTAINER_SQL",
        ),
        "asset-factory-plugin" => array( 
            "table"   => "cxml_assetfactoryplugin",
            "display" => "Asset Factory Plugin",
            "sql"     => "ASSET_FACTORY_PLUGIN_SQL",
        ),
        "asset-factory-plugin-param" => array( 
            "table"   => "cxml_assetfactorypluginparam",
            "display" => "Asset Factory Plugin Param",
            "sql"     => "ASSET_FACTORY_PLUGIN_PARAM_SQL",
        ),
		// all remaining tables removed
    );
    
    $site_name     = "database-test";
    $master_page   = $cascade->getAsset( a\Page::TYPE, 'acl-entry', $site_name );
    $master_format = $cascade->getAsset( a\ScriptFormat::TYPE, '_cascade/formats/acl-entry', $site_name );
    $base_folder   = $cascade->getAsset( a\Folder::TYPE, '/', $site_name );
    $format_folder = $cascade->getAsset( a\Folder::TYPE, '_cascade/formats', $site_name );

    foreach( $page_table as $page_name => $records )
    {
        $table   = $records[ "table" ];
        $display = $records[ "display" ];
        $sql     = $records[ "sql" ];        
        $script =
"#import( 'site://_rwd_common/formats/Upstate/library/vj_library' )
#vjGetObjectByClassName( 'edu.upstate.chanw.db.CascadeDB' )

#set( \$db = \$vjGetObjectByClassName )

#set( \$sql  = \"select count(*) from $table \" )
#set( \$data = \$db.getResultSet( \$sql ) )

#if( \$data.next() )
<pre>

\$data.getString( 1 )
</pre>
#end

#*
#set( \$sql  = \$_FieldTool.in( 'edu.upstate.chanw.db.CascadeDB' ).$sql + 
    ' ' )

#set( \$data = \$db.getData( \$sql ) )

#if( \$data.size() > 0 )
  <p>&#160;</p>
  <p>\$data.size() records.</p>

  <table class=\"tcellpadding2 tcellspacing1\">
  <tr class=\"bg1 text_white\">
    <th></th>
 
  </tr>
  #foreach( \$asset in \$data )
    #if( \$foreach.index % 2 == 0 )
        <tr>
    #else
        <tr class=\"tablerow1\">
    #end  
  
    ## consume the $page_name object
    <td>\$asset.()</td>

  </tr>
  #end
  </table>

#end
*#




\$db.finalize()
";

		// try to retrieve the page
        $page = $cascade->getPage( $page_name, $site_name );
        
        // if page does not exist, create a copy from the master
        if( !isset( $page ) )
            $page = $master_page->copy( $base_folder, $page_name );
            
        // try to retrieve the format
        $format = $cascade->getScriptFormat( '/_cascade/formats/' . $page_name, $site_name );
        
        // if format does not exist, create a copy from the master
        if( !isset( $format ) )
            $format = $master_format->copy( $format_folder, $page_name );
        
        // set the script for each format
        $format->setScript( $script )->edit();
        
		// get the metadata of the page    
        $metadata = $page->getMetadata();
        // set display name and title
        $metadata->setDisplayName( $display )->
            setTitle( $display );
        // attach the format to a region
        $page->setRegionFormat( 'RWD', 'BOTTOM', $format )->
        	// set H1
            setText( "main-content-title", $display )->
            edit();
        //u\DebugUtility::dump( $page->getIdentifiers() );
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
?>