<?php


namespace App\Http\Controllers;

/**
 * Просмотр шаблона для генерации pdf.
 *
 * @package App\Http\Controllers
 */
class TemplateForPdfController extends Controller
{
    public function index()
    {
        return view('template-for-pdf',[
            'surname' => 'Иванов',
            'name' => 'Иван',
            'secondName' => 'Иванович',
            'date' => date('Y-m-d', time())
        ]);
    }
}
