<?php

namespace Concrete\Package\Redirects\Exporters;

use Concrete\Core\Support\Facade\Application;

class Csv
{
    /**
     * @param array $header
     * @param array $data
     * @param string $filename
     */
    public function stream(array $header, array $data, string $filename): void
    {
        $app = Application::getFacadeApplication();

        $fh = fopen('php://temp', 'rwb');
        if ($fh === false) {
            $app->shutdown();
            return;
        }
        fputcsv($fh, $header);
        foreach ($data as $row) {
            fputcsv($fh, $row);
        }
        rewind($fh);
        $csvString = stream_get_contents($fh);
        fclose($fh);
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Cache-Control: private', false);
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '";');
        header('Content-Transfer-Encoding: binary');
        echo $csvString;
        $app->shutdown();
    }
}
