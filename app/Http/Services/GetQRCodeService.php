<?php


namespace App\Http\Services;

use Illuminate\Support\Facades\App;

/**
 * Служба для генерации QR-кода.
 *
 * @package App\Http\Services
 */
class GetQRCodeService implements GetQRCodeServiceInterface
{
    /**
     * Запуск службы.
     *
     * @param array|string $data
     * @return string
     */
    public function run($data) : string
    {
        $QrCode = App::make('QrCode');
        return base64_encode($QrCode::encoding('UTF-8')->generate($data));
    }
}
