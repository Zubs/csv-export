# csv-exporter

Simple class to convert data from arrays to CSV files.

## Example
* Include autoload php:
```php
require_once __DIR__ . '/../vendor/autoload.php';
```

* Use the class:
```php
use App\CSVExport;

$exporter = new CSVExport();
```

* Create CSV file:
```php
$exporter->setColumns(['Name', 'Age', 'Color'])
    ->setRows([
        ['Zubs', 19, 'Red'],
        ['Airbuz', 26, 'Pink'],
        ['Aremu', 46, 'Brown']
    ]);

echo $exporter->execute(); // Returns the path to the created file
```

