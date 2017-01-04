<?php
/*
This program shows how to access the default value of a field.
*/
require_once('auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try 
{
    $dd = $cascade->getAsset( 
        a\DataDefinition::TYPE, "5f4526a58b7f08ee76b12c41cf8ffc56" );

    $attrs = $dd->getField( "choose-type" );
    
    u\DebugUtility::dump( $attrs );
    
    if( isset( $attrs[ 'default' ] ) )
    {
        echo $attrs[ 'default' ];
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

/*
The xml of the field:
    <text type="radiobutton" identifier="choose-type" label="Choose A Type" default="wysiwyg" required="true" help-text="Select a block type">
        <radio-item value="accordion" show-fields="accordion-group"/>
        <radio-item value="contact" show-fields="contact-group"/>
        <radio-item value="quick-links" show-fields="quick-links-group"/>
        <radio-item value="wysiwyg" show-fields="wysiwyg-group"/>
    </text>

The dump of the $attrs variable:
array(8) {
  ["name"]=>
  string(4) "text"
  ["items"]=>
  string(37) "accordion;contact;quick-links;wysiwyg"
  ["type"]=>
  string(11) "radiobutton"
  ["identifier"]=>
  string(11) "choose-type"
  ["label"]=>
  string(13) "Choose A Type"
  ["default"]=>
  string(7) "wysiwyg"
  ["required"]=>
  string(4) "true"
  ["help-text"]=>
  string(19) "Select a block type"
}
*/
?>