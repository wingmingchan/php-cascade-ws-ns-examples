<?php
$xml_url   = "http://web.upstate.edu:8080/ws/services/AssetOperationService?wsdl";
$xsl_url   = "https://raw.githubusercontent.com/qvantel/wsdl-viewer/master/wsdl-viewer.xsl";

try
{
    $xml_doc = new DOMDocument();
    $xsl_doc = new DOMDocument();
    $xml_doc->load( $xml_url );
    $xsl_doc->load( $xsl_url );
    $proc = new XSLTProcessor();
    $proc->importStyleSheet( $xsl_doc );
    
    echo $proc->transformToXML( $xml_doc );
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