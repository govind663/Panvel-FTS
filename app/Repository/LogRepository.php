<?php

namespace App\Repository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LogRepository {

    public function getLogs($id) {
        $logs = DB::table('log')
                ->select( 'user.name as user_name','action.description as action_desc','log.*' )
                ->where('user_id', '=', $id)
                ->orderByDesc('created_at')
                ->get();
                return $logs;
    }

    // Add a log entry for the user with given id.
    public function insertLog($userId, $tableName, $logType){
        $data = [
                    'ip' => request()->ip(),
                    'user_agent' => request()->server('HTTP_USER_AGENT'),
                    'url' => request()->fullUrl(),
                    'referer' => request()->server('HTTP_REFERER'),
                    'action' => "Accessed table: {$tableName} - Action Type: {$logType}",
                    'user_id'=>$userId,
                    'created_at' => now(),
                    'data' => request()->all(),
                ];

        DB::table('logs')->insert([
            'user_id' => $userId,
            'log_date' => now(),
            'table_name' => $tableName,
            'log_type' => $logType,
            'method' => (request()->isMethod('post')) ? 'POST' : ((request()->isMethod('put')) ? 'PUT' : 'GET'),
            'url' => request()->fullUrl(),
            'data' => json_encode($data),
        ]);
    }

}
