<?php
require_once('auth_tutorial7.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $cascade->getAsset( a\TextBlock::TYPE, "388fa7a58b7ffe83164c93149320e775" )->dump();
    echo u\XMLUtility::replaceBrackets( $service->getLastResponse() );
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
<?xml version="1.0" encoding="UTF-8"?> 
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" 
    xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
  <soapenv:Body>
    <readResponse xmlns="http://www.hannonhill.com/ws/ns/AssetOperationService">
      <readReturn>
        <asset>
          <assetFactory xsi:nil="true" />
          <assetFactoryContainer xsi:nil="true" />
          <connectorContainer xsi:nil="true" />
          <contentType xsi:nil="true" />
          <contentTypeContainer xsi:nil="true" />
          <dataDefinition xsi:nil="true" />
          <dataDefinitionContainer xsi:nil="true" />
          <databaseTransport xsi:nil="true" />
          <destination xsi:nil="true" />
          <facebookConnector xsi:nil="true" />
          <feedBlock xsi:nil="true" />
          <file xsi:nil="true" />
          <fileSystemTransport xsi:nil="true" />
          <folder xsi:nil="true" />
          <ftpTransport xsi:nil="true" />
          <googleAnalyticsConnector xsi:nil="true" />
          <group xsi:nil="true" />
          <indexBlock xsi:nil="true" />
          <metadataSet xsi:nil="true" />
          <metadataSetContainer xsi:nil="true" />
          <page xsi:nil="true" />
          <pageConfigurationSet xsi:nil="true" />
          <pageConfigurationSetContainer xsi:nil="true" />
          <publishSet xsi:nil="true" />
          <publishSetContainer xsi:nil="true" />
          <reference xsi:nil="true" />
          <role xsi:nil="true" />
          <scriptFormat xsi:nil="true" />
          <site xsi:nil="true" />
          <siteDestinationContainer xsi:nil="true" />
          <symlink xsi:nil="true" />
          <target xsi:nil="true" />
          <template xsi:nil="true" />
          <textBlock>
            <createdBy>wing</createdBy>
            <createdDate>2016-03-02T18:20:52.004Z</createdDate>
            <expirationFolderId xsi:nil="true" />
            <expirationFolderPath xsi:nil="true" />
            <expirationFolderRecycled>false</expirationFolderRecycled>
            <id>388fa7a58b7ffe83164c93149320e775</id>
            <lastModifiedBy>wing</lastModifiedBy>
            <lastModifiedDate>2016-09-02T19:58:12.664Z</lastModifiedDate>
            <metadata>
              <author>Wing</author>
              <displayName xsi:nil="true" />
              <dynamicFields xsi:nil="true" />
              <endDate xsi:nil="true" />
              <keywords xsi:nil="true" />
              <metaDescription xsi:nil="true" />
              <reviewDate xsi:nil="true" />
              <startDate xsi:nil="true" />
              <summary xsi:nil="true" />
              <teaser xsi:nil="true" />
              <title xsi:nil="true" />
            </metadata>
            <metadataSetId>358be6af8b7ffe83164c9314f9a3c1a6</metadataSetId>
            <metadataSetPath>_common_assets:Block</metadataSetPath>
            <name>ajax-read-profile-php</name>
            <parentFolderId>389094778b7ffe83164c93141fb4b833</parentFolderId>
            <parentFolderPath>_cascade/blocks/code</parentFolderPath>
            <path>_cascade/blocks/code/ajax-read-profile-php</path>
            <siteId>388e29ea8b7ffe83164c9314ead8aaa9</siteId>
            <siteName>cascade-admin-webapp</siteName>
            <text>Mike</text>
          </textBlock>
          <transportContainer xsi:nil="true" />
          <twitterConnector xsi:nil="true" />
          <twitterFeedBlock xsi:nil="true" />
          <user xsi:nil="true" />
          <wordPressConnector xsi:nil="true" />
          <workflowConfiguration xsi:nil="true" />
          <workflowDefinition xsi:nil="true" />
          <workflowDefinitionContainer xsi:nil="true" />
          <xhtmlDataDefinitionBlock xsi:nil="true" />
          <xmlBlock xsi:nil="true" />
          <xsltFormat xsi:nil="true" />
        </asset>
        <message xsi:nil="true" />
        <success>true</success>
      </readReturn>
    </readResponse>
  </soapenv:Body>
</soapenv:Envelope>

object(stdClass)#14 (18) {
  ["id"]=>
  string(32) "388fa7a58b7ffe83164c93149320e775"
  ["name"]=>
  string(21) "ajax-read-profile-php"
  ["parentFolderId"]=>
  string(32) "389094778b7ffe83164c93141fb4b833"
  ["parentFolderPath"]=>
  string(20) "_cascade/blocks/code"
  ["path"]=>
  string(42) "_cascade/blocks/code/ajax-read-profile-php"
  ["lastModifiedDate"]=>
  string(24) "2016-09-02T19:58:12.664Z"
  ["lastModifiedBy"]=>
  string(4) "wing"
  ["createdDate"]=>
  string(24) "2016-03-02T18:20:52.004Z"
  ["createdBy"]=>
  string(4) "wing"
  ["siteId"]=>
  string(32) "388e29ea8b7ffe83164c9314ead8aaa9"
  ["siteName"]=>
  string(20) "cascade-admin-webapp"
  ["metadata"]=>
  object(stdClass)#15 (11) {
    ["author"]=>
    string(4) "Wing"
    ["displayName"]=>
    NULL
    ["endDate"]=>
    NULL
    ["keywords"]=>
    NULL
    ["metaDescription"]=>
    NULL
    ["reviewDate"]=>
    NULL
    ["startDate"]=>
    NULL
    ["summary"]=>
    NULL
    ["teaser"]=>
    NULL
    ["title"]=>
    NULL
    ["dynamicFields"]=>
    NULL
  }
  ["metadataSetId"]=>
  string(32) "358be6af8b7ffe83164c9314f9a3c1a6"
  ["metadataSetPath"]=>
  string(20) "_common_assets:Block"
  ["expirationFolderId"]=>
  NULL
  ["expirationFolderPath"]=>
  NULL
  ["expirationFolderRecycled"]=>
  bool(false)
  ["text"]=>
  string(4) "Mike"
}
*/
?>