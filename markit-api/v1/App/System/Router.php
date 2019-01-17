<?php

// Controller Registration
// ===============================================================================================
$controllers = array ( 
    "Hello","Login","Regist","Kehadiran","Select","Admin",
);

// **
// *
// *    Default Router
// *
// **
$rmp->map(['GET', 'POST'], '/', function( $request, $response, $args ) {

    return $response->withJSON (
        array (
            "name"          => "MarkIt REST API",
            "version"       => "1.0",
            "description"   => "Authentication is needed to access the API."
        )
    );
});

// **
// *
// *    Dynamic Router
// *
// **
function requiringRouter ( $i = 0 ) {

    global $controllers, $rmp;

    $_SESSION['controllerName'] = $controllers[$i];
    
    $rmp->group( '/' . strtolower ( $_SESSION['controllerName'] ), function()
    {
        if ( file_exists ( CONTROLLER . ucfirst( $_SESSION['controllerName'] ) . PHP ) ) {
            require_once ( CONTROLLER . ucfirst( $_SESSION['controllerName'] ) . PHP );
        }    
    });

    if ( $i < sizeof ( $controllers ) - 1 ) requiringRouter ( $i + 1 );
}

requiringRouter ();


?>
