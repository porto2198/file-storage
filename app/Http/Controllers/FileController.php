<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class FileController extends Controller
{
    /**
     * @param StoreFileRequest $request
     * @return JsonResponse
     */
    public function store(StoreFileRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            $data['file_data'] = $this->saveFile('files', 'file_data');

            Log::info('data', [$data]);

            return response()->json([
                'message' => 'Archivo guardado exitosamente.',
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            Log::error('error', [$exception->getMessage()]);

            return response()->json([
                'errors' => $exception->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param string $path
     * @param string $fileName
     * @return string
     */
    protected function saveFile(string $path, string $fileName): string
    {
        return request()->file($fileName)->storeAs($path, request()->input('file_name'));
    }
}
