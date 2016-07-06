<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

$parent_folder_path = "/formats/velocity/api-documentation/java-util";

$data = array(

    // ArrayList
    array(
        "java-util-array-list",
        "ArrayList<E>",
        "ArrayList<E>",
        "api-java-util-array-list-script",
        array(
            "java.util.ArrayList,E"
        ),
    ),
    
    // Calendar
    array(
        "java-util-calendar",
        "Calendar",
        "Calendar",
        "api-java-util-calendar-script",
        array(
            "java.util.Calendar"
        )
    ),
    
    // Date
    array(
        "java-util-date",
        "Date",
        "Date",
        "api-java-util-date-script",
        array(
            "java.util.Date"
        )
    ),
    
    // GregorianCalendar
    array(
        "java-util-gregorian-calendar",
        "GregorianCalendar",
        "GregorianCalendar",
        "api-java-util-gregorian-calendar-script",
        array(
            "java.util.GregorianCalendar",
            "java.util.Calendar"
        )
    ),
    
    // HashMap
    array(
        "java-util-hash-map",
        "HashMap<K,V>",
        "HashMap<K,V>",
        "api-java-util-hash-map-script",
        array(
            "java.util.HashMap,K,V"
        )
    ),
    
    // StringTokenizer
    array(
        "java-util-string-tokenizer",
        "StringTokenizer",
        "StringTokenizer",
        "api-java-util-string-tokenizer-script",
        array(
            "java.util.StringTokenizer"
        )
    ),
    
);
?>