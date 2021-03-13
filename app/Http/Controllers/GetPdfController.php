<?php


namespace App\Http\Controllers;

use App\Http\Services\GetPdfServiceInterface;
use App\Http\Services\GetQRCodeService;
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

    /**
     * Служба для генерации QR-кода.
     *
     * @var GetQRCodeService
     */
    public GetQRCodeService $QRCodeService;

    public string $viewPath = 'template-for-pdf';

    public function __construct(GetPdfServiceInterface $pdfService, GetQRCodeService $QRCodeService)
    {
        $this->pdfService = $pdfService;
        $this->QRCodeService = $QRCodeService;
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

        $QrCode = $this->getQrCodeFromRequestData($request);

        return $this->pdfService->run($request , $this->viewPath, $QrCode);
    }

    private function getQrCodeFromRequestData(Request $request) : string
    {
        $QrCode = $this->QRCodeService->run($request->surname . ' '
            . $request->name . ' '
            . $request->second_name . ', '
            . $request->date);
        return $QrCode;
    }
}
