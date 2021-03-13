<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Интерфейс для службы генерации pdf.
 *
 * @package App\Http\Services
 */
interface GetPdfServiceInterface
{
    /**
     * Запуск службы.
     *
     * @param Request $request
     * @param string $view
     * @return Response
     */
    public function run(Request $request, string $view) : Response;
}
