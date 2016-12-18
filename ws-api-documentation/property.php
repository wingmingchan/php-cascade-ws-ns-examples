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
        "cascade_ws_property\Abilities" =>
            "/web-services/api/property-classes/abilities",
        "cascade_ws_property\AccessRightsInformation" =>
/*/
           "/web-services/api/property-classes/access-rights-information",
/*/
        "cascade_ws_property\AclEntry" =>
            "/web-services/api/property-classes/acl-entry",
            
        "cascade_ws_property\Action" =>
            "/web-services/api/property-classes/action",
        "cascade_ws_property\ActionDefinition" =>
            "/web-services/api/property-classes/action-definition",
        "cascade_ws_property\Child" =>
            "/web-services/api/property-classes/child",
        "cascade_ws_property\ConnectorContentTypeLink" =>
            "/web-services/api/property-classes/connector-content-type-link",
        "cascade_ws_property\ConnectorContentTypeLinkParameter" =>
            "/web-services/api/property-classes/connector-content-type-link-parameter",
        "cascade_ws_property\ConnectorParameter" =>
            "/web-services/api/property-classes/connector-parameter",
        "cascade_ws_property\ContentTypePageConfiguration" =>
            "/web-services/api/property-classes/content-type-page-configuration",
       "cascade_ws_property\DynamicField" =>
            "/web-services/api/property-classes/dynamic-field",
        "cascade_ws_property\DynamicMetadataFieldDefinition" =>
            "web-services/api/property-classes/dynamic-metadata-field-definition",
        "cascade_ws_property\FieldValue" =>
            "web-services/api/property-classes/field-value",
        "cascade_ws_property\GlobalAbilities" =>
            "web-services/api/property-classes/global-abilities",
        "cascade_ws_property\Identifier" =>
            "web-services/api/property-classes/identifier",
        "cascade_ws_property\InlineEditableField" =>
            "web-services/api/property-classes/inline-editable-field",
        "cascade_ws_property\Metadata" =>
            "web-services/api/property-classes/metadata",
        "cascade_ws_property\PageConfiguration" =>
            "/web-services/api/property-classes/page-configuration",
        "cascade_ws_property\PageRegion" =>
            "/web-services/api/property-classes/page-region",
        "cascade_ws_property\Parameter" =>
            "web-services/api/property-classes/parameter",
        "cascade_ws_property\Path" =>
            "web-services/api/property-classes/path",
        "cascade_ws_property\Plugin" =>
            "web-services/api/property-classes/plugin",
        "cascade_ws_property\PossibleValue" =>
            "/web-services/api/property-classes/possible-value",
        "cascade_ws_property\Property" =>
            "/web-services/api/property-classes/property",
        "cascade_ws_property\PublishableAssetIdentifier" =>
            "/web-services/api/property-classes/publishable-asset-identifier",
        "cascade_ws_property\RoleAssignment" =>
            "/web-services/api/property-classes/role-assignment",
        "cascade_ws_property\SiteAbilities" =>
            "/web-services/api/property-classes/site-abilities",
        "cascade_ws_property\Step" =>
            "/web-services/api/property-classes/step",
        "cascade_ws_property\StepDefinition" =>
            "/web-services/api/property-classes/step-definition",
        "cascade_ws_property\StructuredData" =>
            "/web-services/api/property-classes/structured-data",
        "cascade_ws_property\StructuredDataNode" =>
            "/web-services/api/property-classes/structured-data-node",
        "cascade_ws_property\TriggerDefinition" =>
            "/web-services/api/property-classes/trigger-definition",
        "cascade_ws_property\Workflow" =>
            "/web-services/api/property-classes/workflow",
        "cascade_ws_property\WorkflowSettings" =>
            "/web-services/api/property-classes/workflow-settings",
/*/
/*/  /*/

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
    $page_id = $service->createId( a\Page::TYPE,  "/web-services/api/property-classes/index", $site_name );
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