<?php

namespace App;

class CSVExport
{
    private string $separator = ',';
    private array $columns;
    private array $rows;
    private string $filename = 'export';

    public function __construct()
    {
    }

    public function setSeparator(string $separator): CSVExport
    {
        $this->separator = $separator;
        return $this;
    }

    public function setColumns(array $columns): CSVExport
    {
        $this->columns = $columns;
        return $this;
    }

    public function setRows(array $rows): CSVExport
    {
        $this->rows = $rows;
        return $this;
    }

    public function setFilename(string $filename): CSVExport
    {
        $this->filename = $filename;
        return $this;
    }

    public function execute()
    {
        $columns = $this->columns;
        $rows = $this->rows;

        $csv_content = $this->generateCSV();

        ob_end_clean();

        if (!file_exists(dirname(__FILE__, 2) . '/uploads')) {
            mkdir(dirname(__FILE__, 2) . '/uploads');
        }

        $file = $this->filename . '_' . time() . '.csv';
        $path = dirname(__FILE__, 2) . '/uploads' . DIRECTORY_SEPARATOR . $file;
        $csv_file = fopen($path,"w") or die('Unable to read file');
        fwrite($csv_file, $csv_content);
        fclose($csv_file);

        return $path;
    }

    private function generateCSV()
    {
        $csv_output = '';

        if (count($this->columns)) {
            foreach ($this->columns as $column) {
                $csv_output = $csv_output . $column . $this->separator;
            }

            $csv_output = substr($csv_output, 0, -1);
        }

        $csv_output .= "\n";

        foreach ($this->rows as $row) {
            $fields = array_values((array) $row);

            $csv_output .= implode($this->separator, $fields);
            $csv_output .= "\n";
        }

        return $csv_output;
    }
}
