<?php

namespace App\Service;

use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;
use Maatwebsite\Excel\Excel;

class ExportService
{
    protected $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    public function generateExport($query, $view, $filename, $format)
    {
        $logs = $query->get();

        if ($format === 'pdf') {
            $options = new Options();
            $options->set('isRemoteEnabled', true);
            $pdf = Pdf::loadView($view, compact('logs'))->setPaper('a4', 'landscape');
            return $pdf->download($filename . '.pdf');
        } elseif ($format === 'excel') {
            $exportClass = 'App\Exports\\' . $filename . 'Export';
            return $this->excel->download(new $exportClass($logs), $filename . '.xlsx');
        }

        return redirect()->back()->with('error', 'Format tidak valid');
    }
}
