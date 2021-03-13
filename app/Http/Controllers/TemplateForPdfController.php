<?php


namespace App\Http\Controllers;

use App\Http\Services\GetQRCodeService;

/**
 * Просмотр шаблона для генерации pdf.
 *
 * @package App\Http\Controllers
 */
class TemplateForPdfController extends Controller
{
    /**
     * Служба для генерации QR-кода.
     *
     * @var GetQRCodeService
     */
    public GetQRCodeService $QRCodeService;

    public string $viewPath = 'template-for-pdf';

    public function __construct(GetQRCodeService $QRCodeService)
    {
        $this->QRCodeService = $QRCodeService;
    }

    public function index()
    {
        return view($this->viewPath,[
            'surname' => 'Иванов',
            'name' => 'Иван',
            'secondName' => 'Иванович',
            'date' => date('Y-m-d', time()),
            'QrCode' => $this->QRCodeService->run('Тест'),
        ]);
    }
}
