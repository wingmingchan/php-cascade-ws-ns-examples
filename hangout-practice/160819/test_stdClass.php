<?php
/*
stdClass is a PHP class that can be used to create objects of any structure,
containing any data. One difference between an stdClass object and 
an object instantiated from a normal class is that there is no easy way
to define and invoke a method through an stdClass object.
*/
$obj = new stdClass();
$obj->name = "Upstate";
$array = array( 1, 2 );

modifyObject($obj );
modifyArray( $array );

var_dump( $obj );
var_dump( $array );

function modifyObject( $obj )
{
    $obj->name = "medical";
}

function modifyArray( $array )
{
    $array[ 0 ] = 100;
}
?>