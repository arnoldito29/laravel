<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\LogResource;
use App\Services\LogService;

class LogController extends Controller
{
    /**
     * @var LogService
     */
    protected $logService;

    /**
     * LogController constructor.
     * @param LogService $logService
     */
    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $list = $this->logService->getLogs();

        return LogResource::collection($list);
    }
}

