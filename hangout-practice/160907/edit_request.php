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
	$cascade->getAsset( a\TextBlock::TYPE, "388fa7a58b7ffe83164c93149320e775" )->edit();
    echo u\XMLUtility::replaceBrackets( $service->getLastRequest() );
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
<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" 
    xmlns:ns1="http://www.hannonhill.com/ws/ns/AssetOperationService" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
  <SOAP-ENV:Body>
    <ns1:edit>
      <ns1:authentication>
        <ns1:password>password</ns1:password>
        <ns1:username>username</ns1:username>
      </ns1:authentication>
      <ns1:asset>
        <ns1:textBlock>
          <ns1:id>388fa7a58b7ffe83164c93149320e775</ns1:id>
          <ns1:name>ajax-read-profile-php</ns1:name>
          <ns1:parentFolderId>389094778b7ffe83164c93141fb4b833</ns1:parentFolderId>
          <ns1:parentFolderPath>_cascade/blocks/code</ns1:parentFolderPath>
          <ns1:path>_cascade/blocks/code/ajax-read-profile-php</ns1:path>
          <ns1:lastModifiedDate>2016-09-05T15:16:06.350Z</ns1:lastModifiedDate>
          <ns1:lastModifiedBy>wing</ns1:lastModifiedBy>
          <ns1:createdDate>2016-03-02T18:20:52.004Z</ns1:createdDate>
          <ns1:createdBy>wing</ns1:createdBy>
          <ns1:siteId>388e29ea8b7ffe83164c9314ead8aaa9</ns1:siteId>
          <ns1:siteName>cascade-admin-webapp</ns1:siteName>
          <ns1:metadata>
            <ns1:author>Wing</ns1:author>
            <ns1:endDate xsi:nil="true"/>
            <ns1:reviewDate xsi:nil="true"/>
            <ns1:startDate xsi:nil="true"/>
          </ns1:metadata>
          <ns1:metadataSetId>358be6af8b7ffe83164c9314f9a3c1a6</ns1:metadataSetId>
          <ns1:metadataSetPath>_common_assets:Block</ns1:metadataSetPath>
          <ns1:expirationFolderRecycled>false</ns1:expirationFolderRecycled>
          <ns1:text>Mike</ns1:text>
        </ns1:textBlock>
      </ns1:asset>
    </ns1:edit>
  </SOAP-ENV:Body>
</SOAP-ENV:Envelope>
*/
?>