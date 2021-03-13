<?php


namespace App\Http\Services;

/**
 * Интерфейс для службы генерации QR-кода.
 *
 * @package App\Http\Services
 */
interface GetQRCodeServiceInterface
{
    /**
     * @param array|string $data
     * @return mixed
     */
    public function run($data);
}
