<?php

namespace App\Services;

use App\Models\Log;
use App\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Config;

class LogService
{
    /**
     * @var Log
     */
    protected $log;

    /**
     * @var Config
     */
    protected $config;

    /**
     * LogService constructor.
     * @param Log $log
     * @param Config $config
     */
    public function __construct(Log $log, Config $config)
    {
        $this->log = $log;
        $this->config = $config;
    }

    /**
     * @param string $type
     * @param User $user
     * @param array $params
     * @return Log
     */
    public function addLog(string $type, User $user, array $params): Log
    {
        $log = new Log();
        $log->user_id = $user->id;
        $log->type = $type;
        $log->params = json_encode($params);
        $log->save();

        return $log;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getLogs(): LengthAwarePaginator
    {
        $logs = $this->log::select('*');

        return $logs->paginate($this->config::get('list.per_page'));
    }
}

