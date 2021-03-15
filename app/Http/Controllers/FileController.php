<?php


namespace App\Http\Controllers;


use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Возвращение файла клиенту по ссылке.
     *
     * @param $id
     * @return mixed
     */
    public function download(int $id)
    {
        $file = File::findOrFail($id);
        return Storage::download($file->name);
    }
}
