<?php


namespace App\Http\Controllers;

use App\Http\Services\GetPdfServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Генерация pdf по данным формы.
 *
 * @package App\Http\Controllers
 */
class GetPdfController extends Controller
{
    /**
     * Служба для генерации pdf.
     *
     * @var GetPdfServiceInterface
     */
    public GetPdfServiceInterface $pdfService;

    public function __construct(GetPdfServiceInterface $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function render(Request $request) : Response
    {
        $request->validate([
            'surname'  => 'required|max:255',
            'name'  => 'required|max:255',
            'second_name'  => 'nullable|max:255',
            'date' => 'date',
        ]);

        return $this->pdfService->run($request , 'template-for-pdf');
    }
}
