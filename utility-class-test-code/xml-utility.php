<?php 
require_once('auth_dev_app.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $source_template = $source_cascade->getAsset( a\Template::TYPE, "templates/rwd", "_rwd_common" );
    $target_template = $target_cascade->getAsset( a\Template::TYPE, "templates/rwd", "_rwd_common" );
    $source_s_xml    = new \SimpleXMLElement( $source_template->getXml() );
    $target_s_xml    = new \SimpleXMLElement( $target_template->getXml() );
    $source_xml      = $source_s_xml->asXML();
    $target_xml      = $target_s_xml->asXML();

    if( u\XmlUtility::isXmlIdentical( $source_s_xml, $source_s_xml ) )
        echo "Identical", BR;
    else
        echo "Different", BR;
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