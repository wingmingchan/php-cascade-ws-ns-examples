<?php 
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
	$func_names = array( "strpos", "str_replace", "strlen", "strtolower" );
	
	foreach( $func_names as $func_name )
		u\ReflectionUtility::showFunctionSignature( $func_name, true );
		
/* outputs:

strpos( $haystack,  $needle,  $offset )
<hr class='thin width100 text_lightgray bg_lightgray' />
str_replace( $search,  $replace,  $subject,  $replace_count )
<hr class='thin width100 text_lightgray bg_lightgray' />
strlen( $str )
<hr class='thin width100 text_lightgray bg_lightgray' />
strtolower( $str )
<hr class='thin width100 text_lightgray bg_lightgray' />
*/
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>