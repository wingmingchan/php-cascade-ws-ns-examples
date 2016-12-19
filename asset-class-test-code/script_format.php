<?php
require_once('auth_tutorial7.php');

use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$mode = 'all';
//$mode = 'display';
//$mode = 'dump';
//$mode = 'get';
//$mode = 'set';

try
{
    $id = '1841700d8b7f0856002a5e11abd4b871';
    $f = $cascade->getScriptFormat( $id );
    
    switch( $mode )
    {
        case 'all':
        case 'display':
            $f->display();
            
            if( $mode != 'all' )
                break;

        case 'dump':
            $f->dump( true );
            
            if( $mode != 'all' )
                break;
           
        case 'get':
            echo 
                c\L::ID . $f->getId() . BR .
                c\L::NAME . $f->getName() . BR .
                c\L::PARENT_FOLDER_ID . $f->getParentContainerId() . BR .
                c\L::PARENT_FOLDER_PATH . $f->getParentContainerPath() . BR .
                c\L::CREATED_DATE . $f->getCreatedDate() . BR .
                c\L::CREATED_BY . $f->getCreatedBy() . BR .
                c\L::LAST_MODIFIED_DATE . $f->getLastModifiedDate() . BR .
                c\L::LAST_MODIFIED_BY . $f->getLastModifiedBy() . BR .
                c\L::PATH . $f->getPath() . BR;
                
            if( $mode != 'all' )
                break;
           
        case 'set':
$script = <<<SCRIPT
#set( \$data = \$_XPathTool.selectSingleNode( \$contentRoot, "/system-data-structure" ) )
#set( \$to = \$_XPathTool.selectSingleNode( \$data, "to" ).value )
#set( \$subject = \$_XPathTool.selectSingleNode( \$data, "subject" ).value )
#set( \$default_msg = \$_SerializerTool.serialize( \$_XPathTool.selectSingleNode( \$data, "default-msg" ), false ) )
#set( \$default_msg = \$default_msg.replace( '"', "'" ).replaceAll( "<default-msg>", "" ).replaceAll( "</default-msg>", "" ) )
#set( \$thank_you_msg = \$_SerializerTool.serialize( \$_XPathTool.selectSingleNode( \$data, "thank-you-msg" ), false ) )
#set( \$thank_you_msg = \$thank_you_msg.replace( '"', "'" ).replaceAll( "<thank-you-msg>", "" ).replaceAll( "</thank-you-msg>", "" ) )

<!--#passthrough<?php
\$sendTo = "\$to";
\$subjectLine = "\$subject";
\$defaultMsg = "\$default_msg";
\$thankYouMsg = "\$thank_you_msg";

require_once('cascade/email_form.php');
?>#passthrough-->
SCRIPT;
            $f->setScript( $script )->edit();
            $f->displayScript();
            
            if( $mode != 'all' )
                break;
    }
    
    echo u\ReflectionUtility::getClassDocumentation( "cascade_ws_asset\ScriptFormat" );
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