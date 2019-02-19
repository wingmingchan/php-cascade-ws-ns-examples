<?php
require_once( 'auth_tutorial7.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    $block = $cascade->getAsset( a\TextBlock::TYPE, "5470ec9a8b7ffe83552dce4fbd979516" );
    $block->dump();
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
object(stdClass)#14 (18) {
  ["id"]=>
  string(32) "5470ec9a8b7ffe83552dce4fbd979516"
  ["name"]=>
  string(15) "faculty-listing"
  ["parentFolderId"]=>
  string(32) "54713b9e8b7ffe83552dce4f21a3d6e8"
  ["parentFolderPath"]=>
  string(20) "_cascade/blocks/code"
  ["path"]=>
  string(36) "_cascade/blocks/code/faculty-listing"
  ["lastModifiedDate"]=>
  string(24) "2016-11-11T17:30:36.570Z"
  ["lastModifiedBy"]=>
  string(4) "wing"
  ["createdDate"]=>
  string(24) "2016-11-11T17:30:36.570Z"
  ["createdBy"]=>
  string(4) "wing"
  ["siteId"]=>
  string(32) "5470955e8b7ffe83552dce4fd0cacf38"
  ["siteName"]=>
  string(13) "cascade-admin"
  ["metadata"]=>
  object(stdClass)#15 (11) {
    ["author"]=>
    NULL
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
    object(stdClass)#16 (1) {
      ["dynamicField"]=>
      object(stdClass)#17 (2) {
        ["name"]=>
        string(5) "macro"
        ["fieldValues"]=>
        object(stdClass)#18 (1) {
          ["fieldValue"]=>
          object(stdClass)#19 (1) {
            ["value"]=>
            string(0) ""
          }
        }
      }
    }
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
  string(164) ""
}
*/
?>