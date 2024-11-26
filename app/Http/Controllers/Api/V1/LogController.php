<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Jobs\V1\Log as Jobs;
use Illuminate\Http\Response;

class LogController extends Controller
{
    public function index()
    {
        $logs = Jobs\Index::dispatchSync();
        return response()->json(['logs' => $logs], Response::HTTP_OK);
    }
}
