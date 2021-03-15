<?php


namespace App\Http\Controllers;


use App\Http\Services\GetPdfServiceInterface;
use App\Http\Services\GetQRCodeService;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class GetPdfLinkController extends Controller
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

    public function index(Request $request)
    {
        $request->validate([
            'surname'  => 'required|max:255',
            'name'  => 'required|max:255',
            'second_name'  => 'nullable|max:255',
            'date' => 'date',
        ]);

        $filename = $this->getPdfFile($request);
        $file = $this->savePdfFileToDb($filename);

        return response()->json([
            'type' => 'pdf',
            'data' => $file->toArray()
        ]);
    }

    /**
     * Получение QR-кода на основе данных запроса.
     *
     * @param Request $request
     * @return string
     */
    private function getQrCodeFromRequestData(Request $request) : string
    {
        $QrCode = $this->QRCodeService->run($request->surname . ' '
            . $request->name . ' '
            . $request->second_name . ', '
            . $request->date);
        return $QrCode;
    }

    /**
     * Формирование PDF-файла.
     *
     * @param Request $request
     * @return string
     */
    private function getPdfFile(Request $request) : string
    {
        $QrCode = $this->getQrCodeFromRequestData($request);
        $pdf = $this->pdfService->run($request , $this->viewPath, $QrCode);
        $hash = md5($pdf);
        $filename =  $hash . '.pdf';
        Storage::disk('local')->put($filename, $pdf);
        return $filename;
    }

    /**
     * Сохранение данных PDF-файла в БД.
     *
     * @param string $filename
     * @return File
     */
    private function savePdfFileToDb(string $filename) : File
    {
        $file = new File();
        $file->type = 'pdf';
        $file->name = $filename;
        $file->save();
        return $file;
    }
}
