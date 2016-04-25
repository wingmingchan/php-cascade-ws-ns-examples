<?php 
require_once('cascade_ws_ns/auth_sandbox.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$mode       = "XsltFormat";  // an Asset class name
$class_name = "cascade_ws_asset\\" . $mode;
$type       = $class_name::TYPE;
$site_name  = "cascade-admin";

switch( $mode )
{
    case "AssetFactory":
        $asset_id_path = '4332be908b7f085601aaf3b9ab389f68'; // 32-digit hex id
        break;

    case "AssetFactoryContainer":
        $asset_id_path = 'Upstate'; // full path
        break;
        
    case "ContentType":
        $asset_id_path = '78e2271f8b7f0856004564244339ff16';
        break;

    case "ContentTypeContainer":
        // note that the full path does not include "Content Types/"
        $asset_id_path = 'Test Content Type Container'; // full path
        $site_name     = "_common";                     // site name
        break;

    case "DataDefinition":
        $asset_id_path = 'b85f9f508b7ffe83763847bdef290900';
        $site_name     = "_common";
        break;
        
    case "DataDefinitionContainer":
        $asset_id_path = '5501cc048b7f085600ae2282a4d548b7';
        $site_name     = "_common";
        break;
        
    case "DataDefinitionBlock":
        $asset_id_path = '/_cascade/blocks/data/col-openx';
        break;

    case "Destination":
        $asset_id_path = '12bbbe2a8b7f0856002a5e11cdea7a3b';
        break;

    case "FeedBlock":
        $asset_id_path = 'fd8514b88b7f085600694f7603ab9ea5';
        break;

    case "File": // text vs. data
        $asset_id_path = '1682eb548b7f085600a0fcdc9f48f10b';
        break;

    case "Folder":
        $asset_id_path = '943cb40d8b7f0856011c5ec601ad90d4';
        break;

    case "IndexBlock": // blockXML
        $asset_id_path = 'd7ea64328b7f085600a0fcdcc55a297c';
        break;

    case "Group":
        $asset_id_path = 'Administrators'; // group name
        break;

    case "Page": //metadataSetId, metadataSetPath, configurationSetId, configurationSetPath null
        $asset_id_path = '96f6e5138b7f0856002a5e11fa547b61';
        break;

    case "PageConfigurationSet":
        $asset_id_path = '7e0c5b5b8b7f0856015997e41907ebf1';
        $site_name     = "_common";
        break;

    case "PageConfigurationSetContainer":
        $asset_id_path = '64890d7a8b7f085600ae22821b18cabf';
        $site_name     = "_common";
        break;

    case "PublishSet":
        $asset_id_path = '770b51088b7f0856002a5e110c136f0b';
        break;

    case "ScriptFormat":
        $asset_id_path = 'ac8d23e28b7f08560a5840c5257a168c';
        break;

    case "Role":
        $asset_id_path = 150; // role id
        break;
        
    case "Site":
        $asset_id_path = 'cascade-admin'; // site name
        break;

    case "SiteDestinationContainer":
        $asset_id_path = '64c4d4508b7f085600ae22825cb6097c';
        break;

    case "Template":
        $asset_id_path = 'fd27b6798b7f08560159f3f08e013f23';
        break;
        
    case "TextBlock":
        $asset_id_path = '2ed0abe98b7f085601693b9b195aad7a';
        break;
        
    case "User":
        $asset_id_path = 'wing'; // username
        break;
        
    case "XmlBlock":
        $asset_id_path = '3824d9d98b7f0856002a5e112ae7e53f';
        break;

    case "XsltFormat":
        $asset_id_path = '8778dfe18b7f085657c58d66a5c262d6';
        break;
}

try
{
    $cascade->getAsset( $type, $asset_id_path, $site_name )->dump( true );
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
} 
?>