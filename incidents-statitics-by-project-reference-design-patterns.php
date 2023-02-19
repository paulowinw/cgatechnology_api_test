<?php
require_once __DIR__.'/vendor/autoload.php';

use Modules\Incidents\Repositories\IncidentsRepository;

$startDate = !isset($_GET['startDate']) ? date('d/m/Y', strtotime('-1 year')) : $_GET['startDate'];
$endDate = !isset($_GET['endDate']) ? date('d/m/Y') : $_GET['endDate'];

$repo = new IncidentsRepository();
$repo->getIncidentProjectsByRangeDate($startDate, $endDate);
$repo->jsonExit();
