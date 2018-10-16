<?php

error_reporting(E_ALL);

// On démarre les sessions
session_start();

// Charge de façon dynamique tous les fichiers
require(__DIR__ . '/vendor/autoload.php');

// FrontController
$app = new MealOclock\Application();

// Liste de routes
$app->initRoutes();

// Matching des routes ($match)
$app->matching();
