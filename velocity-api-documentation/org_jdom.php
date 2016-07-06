<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$parent_folder_path = "/formats/velocity/api-documentation/org-jdom";

$data = array(

    // Attribute
    array(
        "org-jdom-attribute",
        "Attribute",
        "Attribute",
        "api-org-jdom-attribute-script",
        array(
            "org.jdom.Attribute",
        ),
    ),
    
    // Element
    array(
        "org-jdom-element",
        "Element",
        "Element",
        "api-org-jdom-element-script",
        array(
            "org.jdom.Element",
            "org.jdom.Content"
        ),
    ),
    
    // XPath
    array(
        "org-jdom-xpath-jaxen-xpath",
        "XPath",
        "XPath",
        "api-org-jdom-xpath-jaxen-xpath-script",
        array(
            "org.jdom.xpath.JaxenXPath ",
            "org.jdom.xpath.XPath"
        ),
    ),
    
    
    
);
?>