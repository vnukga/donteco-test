<?php

namespace App\Http\Services;

use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

/**
 * Служба для генерации pdf.
 *
 * @package App\Http\Services
 */
class GetPdfService implements GetPdfServiceInterface
{
    /**
     * Имя сгенерированного файла.
     *
     * @var string
     */
    public $filename = 'reference.pdf';

    /**
     * Запуск службы.
     *
     * @param Request $request
     * @param string $view
     * @return Response
     */
    public function run(Request $request, string $view) : Response
    {
        /**
         * @var $pdf PDF
         */
        $pdf = App::make('dompdf.wrapper');
        $pdf = $pdf->loadView($view, [
            'surname'  => $request->surname,
            'name'  => $request->name,
            'secondName'  => $request->second_name,
            'date' => $request->date,
        ]);
        return $pdf->download($this->filename);
    }
}
