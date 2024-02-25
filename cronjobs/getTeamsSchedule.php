<?php
require_once '../vendor/autoload.php';
$app = require_once '../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();


$apiTeams = app(\App\Http\Controllers\Api\GetdataFootball::class);
$apiTeams->GetTeamSchedule();
$apiTeams->GetTeamDateHistory();

