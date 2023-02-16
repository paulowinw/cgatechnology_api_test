<?php
require_once __DIR__.'/vendor/autoload.php';

use Modules\Incidents\Repositories\IncidentsRepository;

$repo = new IncidentsRepository();
$repo->getIncidentsByRangeDate(1613404241, 1676476251);
$repo->jsonExit();
