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
    $site_name = "web-services";
 
    $class_page_array = array(

        "cascade_ws_property\AccessRightsInformation" =>
            "/api/property-classes/access-rights-information",
       "cascade_ws_property\AclEntry" =>
            "/api/property-classes/acl-entry",
        "cascade_ws_property\Action" =>
            "/api/property-classes/action",
        "cascade_ws_property\ActionDefinition" =>
            "/api/property-classes/action-definition",
        "cascade_ws_property\Child" =>
            "/api/property-classes/child",
        "cascade_ws_property\ConnectorContentTypeLink" =>
            "/api/property-classes/connector-content-type-link",
        "cascade_ws_property\ConnectorContentTypeLinkParameter" =>
            "/api/property-classes/connector-content-type-link-parameter",
        "cascade_ws_property\ConnectorParameter" =>
            "/api/property-classes/connector-parameter",
        "cascade_ws_property\ContentTypePageConfiguration" =>
            "/api/property-classes/content-type-page-configuration",
       "cascade_ws_property\DynamicField" =>
            "/api/property-classes/dynamic-field",
        "cascade_ws_property\DynamicMetadataFieldDefinition" =>
            "/api/property-classes/dynamic-metadata-field-definition",
        "cascade_ws_property\FieldValue" =>
            "/api/property-classes/field-value",
        "cascade_ws_property\GlobalAbilities" =>
            "/api/property-classes/global-abilities",
        "cascade_ws_property\Identifier" =>
            "/api/property-classes/identifier",
        "cascade_ws_property\InlineEditableField" =>
            "/api/property-classes/inline-editable-field",
        "cascade_ws_property\Metadata" =>
            "/api/property-classes/metadata",
        "cascade_ws_property\PageConfiguration" =>
            "/api/property-classes/page-configuration",
        "cascade_ws_property\PageRegion" =>
            "/api/property-classes/page-region",
        "cascade_ws_property\Parameter" =>
            "/api/property-classes/parameter",
        "cascade_ws_property\Path" =>
            "/api/property-classes/path",
        "cascade_ws_property\Plugin" =>
            "/api/property-classes/plugin",
        "cascade_ws_property\PossibleValue" =>
            "/api/property-classes/possible-value",
        "cascade_ws_property\Property" =>
            "/api/property-classes/property",
        "cascade_ws_property\PublishableAssetIdentifier" =>
            "/api/property-classes/publishable-asset-identifier",
        "cascade_ws_property\RoleAssignment" =>
            "/api/property-classes/role-assignment",
        "cascade_ws_property\SiteAbilities" =>
            "/api/property-classes/site-abilities",
        "cascade_ws_property\Step" =>
            "/api/property-classes/step",
        "cascade_ws_property\StepDefinition" =>
            "/api/property-classes/step-definition",
        "cascade_ws_property\StructuredData" =>
            "/api/property-classes/structured-data",
        "cascade_ws_property\StructuredDataNode" =>
            "/api/property-classes/structured-data-node",
        "cascade_ws_property\TriggerDefinition" =>
            "/api/property-classes/trigger-definition",

        "cascade_ws_property\Workflow" =>
            "/api/property-classes/workflow",


        "cascade_ws_property\WorkflowSettings" =>
            "/api/property-classes/workflow-settings",
/*/
/*//*/
/*/
  
        

    );
    
    foreach( $class_page_array as $class_name => $page_path )
    {
        $page = $cascade->getAsset( a\Page::TYPE, $page_path, $site_name );  
        $page->setText(
            "main-group;wysiwyg",
            u\ReflectionUtility::getClassDocumentation( $class_name )
        )->edit()->publish();
    }
    
    // publish the index page
    $page_id = $service->createId( a\Page::TYPE,  "/api/property-classes/index", $site_name );
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