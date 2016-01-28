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
        "asset-stats" => array( 
            "table"   => "cxml_assetstats",
            "display" => "Asset Stats",
            "sql"     => "ASSET_STATS_SQL",
        ),
        "audit" => array( 
            "table"   => "cxml_audit",
            "display" => "Audit",
            "sql"     => "AUDIT_SQL",
        ),
        "content-type" => array( 
            "table"   => "cxml_contenttype",
            "display" => "Content Type",
            "sql"     => "CONTENT_TYPE_SQL",
        ),
        "content-type-container" => array( 
            "table"   => "cxml_contenttypecontainer",
            "display" => "Content Type Container",
            "sql"     => "CONTENT_TYPE_CONTAINER_SQL",
        ),
        "content-type-inline-field" => array( 
            "table"   => "cxml_ct_inline_field",
            "display" => "Content Type Inline Field",
            "sql"     => "CONTENT_TYPE_INLINE_FIELD_SQL",
        ),
        "content-type-page-configuration" => array( 
            "table"   => "cxml_ct_pageconfiguration",
            "display" => "Content Type Page Configuration",
            "sql"     => "CONTENT_TYPE_PAGE_CONFIGURATION_SQL",
        ),
        "destination" => array( 
            "table"   => "cxml_destination",
            "display" => "Destination",
            "sql"     => "DESTINATION_SQL",
        ),
        "dynamic-metadata-field" => array( 
            "table"   => "cxml_dynamicmetadatafield",
            "display" => "Dynamic Metadata Field",
            "sql"     => "DYNAMIC_METADATA_FIELD_SQL",
        ),
        "dynamic-metadata-field-definition" => array( 
            "table"   => "cxml_dynamicmetadatafielddef",
            "display" => "Dynamic Metadata Field Definition",
            "sql"     => "DYNAMIC_METADATA_FIELD_DEFINITION_SQL",
        ),
        "entity-lock" => array( 
            "table"   => "cxml_entitylock",
            "display" => "Entity Lock",
            "sql"     => "ENTITY_LOCK_SQL",
        ),
        "entity-metadata" => array( 
            "table"   => "cxml_entitymetadata",
            "display" => "Entity Metadata",
            "sql"     => "ENTITY_METADATA_SQL",
        ),
        "entity-relation" => array( 
            "table"   => "cxml_entityrelation",
            "display" => "Entity Relation",
            "sql"     => "ENTITY_RELATION_SQL",
        ),
        "folder-content" => array( 
            "table"   => "cxml_foldercontent",
            "display" => "Folder Content",
            "sql"     => "FOLDER_CONTENT_SQL",
        ),
        "group" => array( 
            "table"   => "cxml_group",
            "display" => "Group",
            "sql"     => "GROUP_SQL",
        ),
        "last-modified" => array( 
            "table"   => "cxml_last_modified",
            "display" => "Last Modified",
            "sql"     => "LAST_MODIFIED_SQL",
        ),
        "mail" => array( 
            "table"   => "cxml_mail",
            "display" => "Mail",
            "sql"     => "MAIL_SQL",
        ),
        "metadata-set" => array( 
            "table"   => "cxml_metadataset",
            "display" => "Metadata Set",
            "sql"     => "METADATA_SET_SQL",
        ),
        "metadata-set-container" => array( 
            "table"   => "cxml_metadatasetcontainer",
            "display" => "Metadata Set Container",
            "sql"     => "METADATA_SET_CONTAINER_SQL",
        ),
        "page-configuration" => array( 
            "table"   => "cxml_pageconfiguration",
            "display" => "Page Configuration",
            "sql"     => "PAGE_CONFIGURATION_SQL",
        ),
        "page-configuration-set" => array( 
            "table"   => "cxml_pageconfigurationset",
            "display" => "Page Configuration Set",
            "sql"     => "PAGE_CONFIGURATION_SET_SQL",
        ),
        "page-configuration-set-container" => array( 
            "table"   => "cxml_pageconfigsetcont",
            "display" => "Page Configuration Set Container",
            "sql"     => "PAGE_CONFIGURATION_SET_CONTAINER_SQL",
        ),
        "page-region" => array( 
            "table"   => "cxml_pageregion",
            "display" => "Page Region",
            "sql"     => "PAGE_REGION_SQL",
        ),
        "publish-request" => array( 
            "table"   => "cxml_publishrequest",
            "display" => "Publish Request",
            "sql"     => "PUBLISH_REQUEST_SQL",
        ),
        "publish-set" => array( 
            "table"   => "cxml_publishset",
            "display" => "Publish Set",
            "sql"     => "PUBLISH_SET_SQL",
        ),
        "publish-set-record" => array( 
            "table"   => "cxml_publishsetrecord",
            "display" => "Publish Set Record",
            "sql"     => "PUBLISH_SET_RECORD_SQL",
        ),
        "recycle-record" => array( 
            "table"   => "cxml_recyclerecord",
            "display" => "Recycle Record",
            "sql"     => "RECYCLE_RECORD_SQL",
        ),
        "roles" => array( 
            "table"   => "cxml_roles",
            "display" => "Roles",
            "sql"     => "ROLE_SQL",
        ),
        "site" => array( 
            "table"   => "cxml_site",
            "display" => "Site",
            "sql"     => "SITE_SQL",
        ),
        "structured-data" => array( 
            "table"   => "cxml_structureddata",
            "display" => "Structured Data",
            "sql"     => "STRUCTURED_DATA_SQL",
        ),
        "structured-data-definition" => array( 
            "table"   => "cxml_structureddatadefinition",
            "display" => "Structured Data Definition",
            "sql"     => "STRUCTURED_DATA_DEFINITION_SQL",
        ),
        "structured-data-definition-container" => array( 
            "table"   => "cxml_structureddatadefcont",
            "display" => "Structured Data Definition Container",
            "sql"     => "STRUCTURED_DATA_DEFINITION_CONTAINER_SQL",
        ),
        "target" => array( 
            "table"   => "cxml_target",
            "display" => "Target",
            "sql"     => "TARGET_SQL",
        ),
        "transport" => array( 
            "table"   => "cxml_transport",
            "display" => "Transport",
            "sql"     => "TRANSPORT_SQL",
        ),
        "transport-container" => array( 
            "table"   => "TRANSPORT_CONTAINER_SQL",
            "display" => "Transport Container",
            "sql"     => "cxml_transportcontainer",
        ),
        "user" => array( 
            "table"   => "cxml_user",
            "display" => "User",
            "sql"     => "USER_SQL",
        ),
        "workflow" => array( 
            "table"   => "cxml_workflow",
            "display" => "workflow",
            "sql"     => "WORKFLOW_SQL",
        ),
        "workflow-action" => array( 
            "table"   => "cxml_workflowaction",
            "display" => "Workflow Action",
            "sql"     => "WORKFLOW_ACTION_SQL",
        ),
        "workflow-definition" => array( 
            "table"   => "cxml_workflowdefinition",
            "display" => "Workflow Definition",
            "sql"     => "WORKFLOW_DEFINITION_SQL",
        ),
        "workflow-definition-container" => array( 
            "table"   => "cxml_workflowdefcontainer",
            "display" => "Workflow Definition Container",
            "sql"     => "WORKFLOW_DEFINITION_CONTAINER_SQL",
        ),
        "workflow-history" => array( 
            "table"   => "cxml_workflowhistory",
            "display" => "Workflow History",
            "sql"     => "WORKFLOW_HISTORY_SQL",
        ),
        "workflow-step" => array( 
            "table"   => "cxml_workflowstep",
            "display" => "Workflow Step",
            "sql"     => "WORKFLOW_STEP_SQL",
        ),
        "xml" => array( 
            "table"   => "cxml_xml",
            "display" => "XML",
            "sql"     => "XML_DATA_SQL",
        ),
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