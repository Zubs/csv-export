<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\CSVExport;
use App\CSVFromJson;

$exporter = new CSVExport();
$exporter->setColumns(['Name', 'Age', 'Color'])
    ->setRows([
        ['Zubs', 19, 'Red'],
        ['Airbuz', 26, 'Pink'],
        ['Aremu', 46, 'Brown']
    ]);

echo $exporter->execute();

$JSONCSVExporter = new CSVFromJson(__DIR__ . '/test.json');
$JSONCSVExporter->execute();

// var_dump($JSONCSVExporter);