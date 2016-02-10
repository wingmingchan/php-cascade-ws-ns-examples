<?php
/*
This program can be used to create a feed,
containing the audits of an asset. The asset id and type must be,
and audit type can be,
passed in as parts of the query string. The url of this program
then can be fed into a feed block and the block will be populated
with the retrieved XML.

Example URL:
http://upstate.edu/../audits_report.php?asset_id=7e4cb5fa8b7f08ee2ce9a0ad1e62f8ef&asset_type=datadefinition&audit_type=edit

What this report can produce:
<audits>
  <audit>
    <user>chanw</user>
    <date>2016-01-26</date>
    <action>edit</action>
    <identifier>7e4cb5fa8b7f08ee2ce9a0ad1e62f8ef</identifier>
  </audit>
  <audit>
    <user>chanw</user>
    <date>2016-01-26</date>
    <action>edit</action>
    <identifier>7e4cb5fa8b7f08ee2ce9a0ad1e62f8ef</identifier>
  </audit>
  <audit>
    <user>chanw</user>
    <date>2016-01-26</date>
    <action>edit</action>
    <identifier>7e4cb5fa8b7f08ee2ce9a0ad1e62f8ef</identifier>
  </audit>
</audits>
*/

require_once('cascade_ws_ns/auth_web_services_for_feeds.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    // retrieve the required information
    $asset_id   = ( isset( $_GET[ "asset_id" ] ) ? $_GET[ "asset_id" ] : "" );
    $asset_type = ( isset( $_GET[ "asset_type" ] ) ? $_GET[ "asset_type" ] : "" );
    $audit_type = ( isset( $_GET[ "audit_type" ] ) ? $_GET[ "audit_type" ] : "" );
    
    if( $asset_id != "" &&  $service->isHexString( $asset_id ) &&
        $asset_type != "" && array_key_exists( $asset_type, c\T::$type_class_name_map )
    )
    {
        if( !isset( $audit_type ) )
            $audit_type = "";
            
        $audits = 
            $cascade->getAudits(
                $cascade->getAsset( $asset_type, $asset_id ),
                $audit_type
            );
            
        if( count( $audits ) > 0 )
        {
            $xml = "<audits>";
            
            foreach( $audits as $audit )
            {
                $xml .= "<audit>";
                $xml .= "<user>" .       $audit->getUser() . "</user>";
                $xml .= "<date>" .       $audit->getDate()->format( "Y-m-d" ) . "</date>";
                $xml .= "<action>" .     $audit->getAction() . "</action>";
                $xml .= "<identifier>" . $audit->getIdentifier()->getId() . "</identifier>";
                $xml .= "</audit>";
            }
            
            $xml .= "</audits>";
        }
        
        if( isset( $xml ) )
            echo $xml;
    }
    else
    {
        echo "<error>No valid ID/type supplied.</error>";
    }
}
catch( \Exception $e ) 
{
    echo "<error>$e</error>";
}
?>