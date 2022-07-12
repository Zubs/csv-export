<?php

namespace App;

class CSVFromJson
{
    private $separator = ",";
    private $filename = 'export';
    private $json_file;

    public function __construct(string $file_path, string $filename = null, string $separator = null)
    {
        $this->json_file = $file_path;
        $this->filename = $filename ?? $this->filename;
        $this->separator = $separator ?? $this->separator;
    }

    public function execute()
    {
        // var_dump($this->process_file());
        $this->process_file();
    }

    private function process_file()
    {
        $json_content = file_get_contents($this->json_file);
        $json_content = json_decode($json_content);
        $csv_content = "";

        foreach ($json_content as $key => $value) {
            $csv_content .= $key . $this->separator;
            
            foreach ($value as $data) $csv_content .= $data . $this->separator;
            $csv_content = substr($csv_content, 0, -1);
            $csv_content .= "\n";
        }

        $csv_content = substr($csv_content, 0, -1);

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
}