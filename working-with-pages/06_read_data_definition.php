<?php
/*
This program shows how to work with a data definition
that contains shared fields.
*/

require_once( 'auth_soap_c8.php' );

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    // dump the original XML
/*
<system-data-structure>
  <group identifier="text-wysiwyg-group" label="Text WYSIWYG Group">
    <text default="Yes" identifier="radio" label="Radio" type="radiobutton">
      <radio-item label="Yes" show-fields="text-wysiwyg-group/text-group" value="Yes"/>
      <radio-item label="No" show-fields="text-wysiwyg-group/wysiwyg-group" value="No"/>
    </text>
    <shared-field identifier="text-groupppppppp" path="text-group"/>
    <shared-field identifier="wysiwyg-group" path="site://wing ming.chan/wysiwyg-group"/>
  </group>
</system-data-structure>
    */
    $dd = $admin->getAsset( a\DataDefinition::TYPE, "cf4a8f51ac1e001b36b86cda3ecb4c24" )->dump();
    // dump the resolved XML
/*
<system-data-structure>
  <group identifier="text-wysiwyg-group" label="Text WYSIWYG Group">
    <text default="Yes" identifier="radio" label="Radio" type="radiobutton">
      <radio-item label="Yes" show-fields="text-wysiwyg-group/text-group" value="Yes"/>
      <radio-item label="No" show-fields="text-wysiwyg-group/wysiwyg-group" value="No"/>
    </text>
    <group identifier="text-groupppppppp" label="Text Group" multiple="true">
        <text identifier="text"/>
    </group>
    <group identifier="wysiwyg-group" label="WYSIWYG Group">
        <text identifier="wysiwyg" wysiwyg="true"/>
    </group>
  </group>
</system-data-structure>
*/
    u\DebugUtility::dump( $dd->getResolvedXml() );
    // dump the identifiers, with the shared fields resolved
/*
array(6) {
  [0]=>
  string(18) "text-wysiwyg-group"
  [1]=>
  string(24) "text-wysiwyg-group;radio"
  [2]=>
  string(36) "text-wysiwyg-group;text-groupppppppp"
  [3]=>
  string(41) "text-wysiwyg-group;text-groupppppppp;text"
  [4]=>
  string(32) "text-wysiwyg-group;wysiwyg-group"
  [5]=>
  string(40) "text-wysiwyg-group;wysiwyg-group;wysiwyg"
}
*/
    u\DebugUtility::dump( $dd->getIdentifiers() );
    
    // dump the info of all shared fields
    foreach( $dd->getSharedFields() as $sf )
    {
    	$sf->dump();
    }
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