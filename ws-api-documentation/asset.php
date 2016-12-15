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
    $site_name = "cascade-admin";
    
    $class_page_array = array(
/*/
        "cascade_ws_asset\Asset" =>
            "/web-services/api/asset-classes/asset",
        "cascade_ws_asset\Audit" =>
            "/web-services/api/audit",
        "cascade_ws_asset\AssetFactory" =>
            "/web-services/api/asset-classes/asset-factory",
        "cascade_ws_asset\AssetFactoryContainer" =>
            "/web-services/api/asset-classes/asset-factory-container",
        "cascade_ws_asset\Block" =>
            "/web-services/api/asset-classes/block",
        "cascade_ws_asset\Cascade" =>
            "/web-services/api/cascade",
        "cascade_ws_asset\ContainedAsset" =>
            "/web-services/api/asset-classes/contained-asset",
        "cascade_ws_asset\Connector" =>
            "/web-services/api/asset-classes/connector",
        "cascade_ws_asset\ConnectorContainer" =>
            "/web-services/api/asset-classes/connector-container",
        "cascade_ws_asset\ContainedAsset" =>
            "/web-services/api/asset-classes/contained-asset",
        "cascade_ws_asset\Container" =>
            "/web-services/api/asset-classes/container",
        "cascade_ws_asset\ContentType" =>
            "/web-services/api/asset-classes/content-type",
        "cascade_ws_asset\ContentTypeContainer" =>
            "/web-services/api/asset-classes/content-type-container",
        "cascade_ws_asset\DatabaseTransport" =>
            "/web-services/api/asset-classes/database-transport",
        "cascade_ws_asset\DataDefinition" =>
            "/web-services/api/asset-classes/data-definition",
        "cascade_ws_asset\DataBlock" =>
            "/web-services/api/asset-classes/data-block",
        "cascade_ws_asset\DataDefinitionBlock" =>
            "/web-services/api/asset-classes/data-definition-block",
        "cascade_ws_asset\DataDefinitionContainer" =>
            "/web-services/api/asset-classes/data-definition-container",
        "cascade_ws_asset\Destination" =>
            "/web-services/api/asset-classes/destination",
        "cascade_ws_asset\FeedBlock" =>
            "/web-services/api/asset-classes/feed-block",
        "cascade_ws_asset\File" =>
            "/web-services/api/asset-classes/file",
        "cascade_ws_asset\FileSystemTransport" =>
            "/web-services/api/asset-classes/file-system-transport",
        "cascade_ws_asset\Folder" =>
            "/web-services/api/asset-classes/folder",
        "cascade_ws_asset\Format" =>
            "/web-services/api/asset-classes/format",
        "cascade_ws_asset\FtpTransport" =>
            "/web-services/api/asset-classes/ftp-transport",
        "cascade_ws_asset\GoogleAnalyticsConnector" =>
            "/web-services/api/asset-classes/google-analytics-connector",
        "cascade_ws_asset\Group" =>
            "/web-services/api/asset-classes/group",
        "cascade_ws_asset\IndexBlock" =>
            "/web-services/api/asset-classes/index-block",
        "cascade_ws_asset\Linkable" =>
            "/web-services/api/asset-classes/linkable",
        "cascade_ws_asset\MetadataSet" =>
            "/web-services/api/asset-classes/metadata-set",
        "cascade_ws_asset\MetadataSetContainer" =>
            "/web-services/api/asset-classes/metadata-set-container",
        "cascade_ws_asset\Page" =>
            "/web-services/api/asset-classes/page",
        "cascade_ws_asset\PageConfigurationSet" =>
            "/web-services/api/asset-classes/page-configuration-set",
        "cascade_ws_asset\PageConfigurationSetContainer" =>
            "/web-services/api/asset-classes/page-configuration-set-container",
        "cascade_ws_asset\PublishSet" =>
            "/web-services/api/asset-classes/publish-set",
        "cascade_ws_asset\PublishSetContainer" =>
            "/web-services/api/asset-classes/publish-set-container",
        "cascade_ws_asset\Reference" =>
            "/web-services/api/asset-classes/reference",
        "cascade_ws_asset\Role" =>
            "/web-services/api/asset-classes/role",
        "cascade_ws_asset\ScheduledPublishing" =>
            "/web-services/api/asset-classes/scheduled-publishing",
        "cascade_ws_asset\ScriptFormat" =>
            "/web-services/api/asset-classes/script-format",
        "cascade_ws_asset\Site" =>
            "/web-services/api/asset-classes/site",
        "cascade_ws_asset\SiteDestinationContainer" =>
            "/web-services/api/asset-classes/site-destination-container",
        "cascade_ws_asset\Symlink" =>
            "/web-services/api/asset-classes/symlink",
        "cascade_ws_asset\Template" =>
            "/web-services/api/asset-classes/template",
        "cascade_ws_asset\TextBlock" =>
            "/web-services/api/asset-classes/text-block",
        "cascade_ws_asset\Transport" =>
            "/web-services/api/asset-classes/transport",
        "cascade_ws_asset\TransportContainer" =>
            "/web-services/api/asset-classes/transport-container",
        "cascade_ws_asset\TwitterConnector" =>
            "/web-services/api/asset-classes/twitter-connector",
        "cascade_ws_asset\User" =>
            "/web-services/api/asset-classes/user",
        "cascade_ws_asset\WordPressConnector" =>
            "/web-services/api/asset-classes/wordpress-connector",
        "cascade_ws_asset\WorkflowDefinition" =>
            "/web-services/api/asset-classes/workflow-definition",
        "cascade_ws_asset\WorkflowDefinitionContainer" =>
            "/web-services/api/asset-classes/workflow-definition-container",
/*/
        "cascade_ws_asset\XmlBlock" =>
            "/web-services/api/asset-classes/xml-block",
/*/
        "cascade_ws_asset\XsltFormat" =>
            "/web-services/api/asset-classes/xslt-format",
            
        // other classes
        "cascade_ws_asset\AssetTree" =>
            "/web-services/api/asset-tree/index",
        "cascade_ws_asset\MessageArrays" =>
            "/web-services/api/message-arrays",
        "cascade_ws_asset\Preference" =>
            "/web-services/api/preference",
/*/
    );
    
    foreach( $class_page_array as $class_name => $page_path )
    {
        $page = $cascade->getAsset( a\Page::TYPE, $page_path, $site_name );  
        $page->setText(
            "main-content-content",
            u\ReflectionUtility::getClassDocumentation( $class_name )
        )->edit()->publish();
    }
    
    // publish the index page
    $page_id = $service->createId( a\Page::TYPE,  "/web-services/api/asset-classes/index", $site_name );
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