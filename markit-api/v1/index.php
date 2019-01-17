<?php

// ===============================================================================================
// MArkIt API v.1.0
// NOVEMBER 2017
// ===============================================================================================

// Set default timezone
date_default_timezone_set('Asia/Jakarta');

// Define markit base directory
define ( "MARKIT_BASE", dirname ( __FILE__ ) . "/" );

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Add the framework
// ===============================================================================================
require_once '../vendor/autoload.php';

// defining word
define ( "PHP", ".php", TRUE);
define ( "MARKIT", "App/System/MarkIt" . PHP, TRUE );
define ( "DATABASE", "App/System/Database" . PHP, TRUE );
define ( "CONFIG", "App/System/Config" . PHP, TRUE );
define ( "DEP", "App/System/Dependencies" . PHP, TRUE );
define ( "ROUTER", "App/System/Router" . PHP, TRUE );
define ( "MIDDLEWARE", "App/Middleware/Middleware" . PHP, TRUE );
define ( "CONTROLLER", "App/Controllers/", TRUE );

// Configure App
require_once ( CONFIG );

// Inisiate the Apps
// ===============================================================================================
$rmp = new \Slim\App( $config );

// set Dependencies
// require_once ( DEP );

// Requiring Database Engine
require_once ( DATABASE );

// Requiring Remap Engine
require_once ( MARKIT );

// set Middleware
require_once ( MIDDLEWARE );

// set Routers
require_once ( ROUTER );

// ===============================================================================================
// CORS Setup
// ===============================================================================================
$rmp->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response->withHeader('Access-Control-Allow-Origin', 'https://remap.id/')
                    ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                    ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

// ===============================================================================================
// Run the App
// ===============================================================================================
$rmp->run();

?>