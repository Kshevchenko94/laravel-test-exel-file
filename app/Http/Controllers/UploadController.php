<?php

namespace App\Http\Controllers;

use App\Http\Requests\RowRequest;
use App\Imports\RowsImport;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
{

    /**
     * @param RowRequest $request
     * @return JsonResponse
     */
    public function exel(RowRequest $request): JsonResponse
    {
        $path = $request->file('file')->store('files');

        Excel::queueImport(new RowsImport(), $path)->onQueue('import');

        return response()->json(["code" => 200, "status" => "OK"]);
    }
}
