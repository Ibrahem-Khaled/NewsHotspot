<?php
require_once '../vendor/autoload.php';
$app = require_once '../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();


$xml = app(\App\Http\Controllers\jobfolder\news_collection::class);
$xml->importXML();
