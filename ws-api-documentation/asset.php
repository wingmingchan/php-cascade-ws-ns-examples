<?php
//require_once('auth_chanw.php');
require_once('auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;
/*//*/
try
{
    $site_name = "web-services";
    
    $class_page_array = array(
/*/  /*/  

        "cascade_ws_asset\Asset" =>
            "/api/asset-classes/asset",
        "cascade_ws_asset\AssetFactory" =>
            "/api/asset-classes/asset-factory",
        "cascade_ws_asset\AssetFactoryContainer" =>
            "/api/asset-classes/asset-factory-container",
        "cascade_ws_asset\Audit" =>
            "/api/audit",
        "cascade_ws_asset\Block" =>
            "/api/asset-classes/block",
        "cascade_ws_asset\Cascade" =>
            "/api/cascade",
        "cascade_ws_asset\CloudTransport" =>
            "/api/asset-classes/cloud-transport",
        "cascade_ws_asset\ContainedAsset" =>
            "/api/asset-classes/contained-asset",
        "cascade_ws_asset\Connector" =>
            "/api/asset-classes/connector",
        "cascade_ws_asset\ConnectorContainer" =>
            "/api/asset-classes/connector-container",
        "cascade_ws_asset\ContainedAsset" =>
            "/api/asset-classes/contained-asset",
        "cascade_ws_asset\Container" =>
            "/api/asset-classes/container",
        "cascade_ws_asset\ContentType" =>
            "/api/asset-classes/content-type",
        "cascade_ws_asset\ContentTypeContainer" =>
            "/api/asset-classes/content-type-container",
        "cascade_ws_asset\DatabaseTransport" =>
            "/api/asset-classes/database-transport",
        "cascade_ws_asset\DataDefinition" =>
            "/api/asset-classes/data-definition",
        "cascade_ws_asset\DataBlock" =>
            "/api/asset-classes/data-block",
        "cascade_ws_asset\DataDefinitionBlock" =>
            "/api/asset-classes/data-definition-block",
        "cascade_ws_asset\DataDefinitionContainer" =>
            "/api/asset-classes/data-definition-container",
        "cascade_ws_asset\Destination" =>
            "/api/asset-classes/destination",
        "cascade_ws_asset\FeedBlock" =>
            "/api/asset-classes/feed-block",
        "cascade_ws_asset\File" =>
            "/api/asset-classes/file",
       "cascade_ws_asset\FileSystemTransport" =>
            "/api/asset-classes/file-system-transport",
/*//*/ 
        "cascade_ws_asset\Folder" =>
            "/api/asset-classes/folder",

        "cascade_ws_asset\Format" =>
            "/api/asset-classes/format",
        "cascade_ws_asset\FtpTransport" =>
            "/api/asset-classes/ftp-transport",
        "cascade_ws_asset\GoogleAnalyticsConnector" =>
            "/api/asset-classes/google-analytics-connector",
        "cascade_ws_asset\Group" =>
            "/api/asset-classes/group",
        "cascade_ws_asset\IndexBlock" =>
            "/api/asset-classes/index-block",
        "cascade_ws_asset\Linkable" =>
            "/api/asset-classes/linkable",
        "cascade_ws_asset\MetadataSet" =>
            "/api/asset-classes/metadata-set",
        "cascade_ws_asset\MetadataSetContainer" =>
            "/api/asset-classes/metadata-set-container",
        "cascade_ws_asset\Page" =>
            "/api/asset-classes/page",
        "cascade_ws_asset\PageConfigurationSet" =>
            "/api/asset-classes/page-configuration-set",
        "cascade_ws_asset\PageConfigurationSetContainer" =>
            "/api/asset-classes/page-configuration-set-container",
        "cascade_ws_asset\PublishSet" =>
            "/api/asset-classes/publish-set",
        "cascade_ws_asset\PublishSetContainer" =>
            "/api/asset-classes/publish-set-container",
        "cascade_ws_asset\Reference" =>
            "/api/asset-classes/reference",
        "cascade_ws_asset\Role" =>
            "/api/asset-classes/role",
        "cascade_ws_asset\ScheduledPublishing" =>
            "/api/asset-classes/scheduled-publishing",
        "cascade_ws_asset\ScriptFormat" =>
            "/api/asset-classes/script-format",
        "cascade_ws_asset\Site" =>
            "/api/asset-classes/site",
        "cascade_ws_asset\SiteDestinationContainer" =>
            "/api/asset-classes/site-destination-container",
/*/
/*/

        "cascade_ws_asset\Symlink" =>
            "/api/asset-classes/symlink",
/*//*/
        "cascade_ws_asset\Template" =>
            "/api/asset-classes/template",
        "cascade_ws_asset\TextBlock" =>
            "/api/asset-classes/text-block",
        "cascade_ws_asset\Transport" =>
            "/api/asset-classes/transport",
        "cascade_ws_asset\TransportContainer" =>
            "/api/asset-classes/transport-container",
        "cascade_ws_asset\TwitterConnector" =>
            "/api/asset-classes/twitter-connector",
        "cascade_ws_asset\User" =>
            "/api/asset-classes/user",
        "cascade_ws_asset\TransportContainer" =>
            "/api/asset-classes/transport-container",
        "cascade_ws_asset\WordPressConnector" =>
            "/api/asset-classes/wordpress-connector",
        "cascade_ws_asset\WorkflowDefinition" =>
            "/api/asset-classes/workflow-definition",
        "cascade_ws_asset\WorkflowDefinitionContainer" =>
            "/api/asset-classes/workflow-definition-container",
        "cascade_ws_asset\XhtmlDataDefinitionBlock" =>
            "/api/asset-classes/xhtml-data-definition-block",
        "cascade_ws_asset\XmlBlock" =>
            "/api/asset-classes/xml-block",
        "cascade_ws_asset\XsltFormat" =>
            "/api/asset-classes/xslt-format",
/*/    
/*/
        // other classes
        "cascade_ws_asset\AssetTree" =>
            "/api/asset-tree/index",

        "cascade_ws_asset\CascadeInstances" =>
            "/api/cascade-instances",

/*/
/*/

        "cascade_ws_asset\Message" =>
            "/api/message",
        "cascade_ws_asset\MessageArrays" =>
            "/api/message-arrays",
/*//*/
        "cascade_ws_asset\Preference" =>
            "/api/preference",
		"cascade_ws_asset\Report" =>
        	"/api/report",
/*/ /*/  
    );
    
    foreach( $class_page_array as $class_name => $page_path )
    {
        $page = $cascade->getAsset( a\Page::TYPE, $page_path, $site_name );  
        $page->setText(
            "main-group;wysiwyg",
            u\ReflectionUtility::getClassDocumentation( $class_name )
        )->edit()->publish();
        
        //echo u\ReflectionUtility::getClassDocumentation( $class_name );
    }
    
    // publish the index page
    $page_id = $service->createId( a\Page::TYPE,  "/api/asset-classes/index", $site_name );
    $service->publish( $page_id );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
catch( \Error $er )
{
    echo S_PRE . $er . E_PRE; 
}

/*
Useful code templates:
    u\ReflectionUtility::showMethodSignatures( 
        "cascade_ws_utility\ReflectionUtility" );
        
    u\ReflectionUtility::showMethodSignature( 
        "cascade_ws_asset\Page", "edit" );
        
    u\ReflectionUtility::showMethodDescription( 
        "cascade_ws_utility\ReflectionUtility", "getMethodInfoByName", true );
        
    u\ReflectionUtility::showMethodExample( 
        "cascade_ws_utility\ReflectionUtility", "getMethodInfoByName", true );

    u\DebugUtility::dump( $page );

    $cascade->getAsset( a\Page::TYPE, "389b32a68b7ffe83164c931497b7bc24" )->dump( true );
*/
?>