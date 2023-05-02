<?php

namespace App\Http\Controllers;

use App\Models\Row;
use Illuminate\Http\JsonResponse;

class OutputController extends Controller
{
    public function output(): JsonResponse
    {
        $rows = Row::getAllRowsByDate();
        return response()->json($rows);
    }
}
