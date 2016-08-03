<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$parent_folder_path = "/formats/velocity/api-documentation/java-lang";

$data = array(

    // Boolean
    array(
        "java-lang-boolean",
        "Boolean",
        "Boolean",
        "api-java-lang-boolean-script",
        array(
            "java.lang.Boolean"
        )
    ),
    
    // Class
    array(
        "java-lang-class",
        "Class",
        "Class",
        "api-java-lang-class-script",
        array(
            "java.lang.Class"
        )
    ),
    
    // Double
    array(
        "java-lang-double",
        "Double",
        "Double",
        "api-java-lang-double-script",
        array(
            "java.lang.Double",
            "java.lang.Number"
        )
    ),
    
    // Integer
    array(
        "java-lang-integer",
        "Integer",
        "Integer",
        "api-java-lang-integer-script",
        array(
            "java.lang.Integer",
            "java.lang.Number"
        )
    ),
    
    // Long
    array(
        "java-lang-long",
        "Long",
        "Long",
        "api-java-lang-long-script",
        array(
            "java.lang.Long",
            "java.lang.Number"
        )
    ),
    
    // Math
    array(
        "java-lang-math",
        "Math",
        "Math",
        "api-java-lang-math-script",
        array(
            "java.lang.Math"
        )
    ),
    
    // String
    array(
        "java-lang-string",
        "String",
        "String",
        "api-java-lang-string-script",
        array(
            "java.lang.String"
        )
    ),
    
    // StringBuffer
    array(
        "java-lang-string-buffer",
        "StringBuffer",
        "StringBuffer",
        "api-java-lang-string-buffer-script",
        array(
            "java.lang.StringBuffer"
        )
    ),
    
    // StringBuilder
    array(
        "java-lang-string-builder",
        "StringBuilder",
        "StringBuilder",
        "api-java-lang-string-builder-script",
        array(
            "java.lang.StringBuilder"
        )
    ),
);
?>