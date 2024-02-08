<?php
require_once '../vendor/autoload.php';
$app = require_once '../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();


$articalArchive = app(\App\Http\Controllers\jobfolder\ArchiveData::class);
$articalArchive->Archive();
