<?php

namespace App\Traits;
use App\Models\DataLog;
use App\Models\LoanLog;
use App\Models\SecurityLog;
use App\Models\UserActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait Loggable
{
    protected function logSecurityEvent($action, $level = 'info', $success = false, $email = null, $details = null)
    {
        SecurityLog::create([
            'email' => $email,
            'action' => $action,
            'level' => $level,
            'success' => $success,
            'ip_address' => Request::ip(),
            'details' => json_encode($details)
        ]);
    }

    protected function logUserActivity($action, $level = 'info', $table = null, $record = null, $old = null, $new = null)
    {
        UserActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'level' => $level,
            'table_name' => $table,
            'record_id' => $record,
            'old_data' => $old,
            'new_data' => $new,
            'ip_address' => Request::ip()
        ]);
    }

    protected function logDataChange($table, $record, $action, $level = 'info', $old = null, $new = null)
    {
        DataLog::create([
            'user_id' => Auth::id(),
            'table_name' => $table,
            'record_id' => $record,
            'action' => $action,
            'level' => $level,
            'old_data' => $old,
            'new_data' => $new,
        ]);
    }

    protected function logLoanActivity($loanId, $action, $level = 'info', $details = null)
    {
        LoanLog::create([
            'user_id' => Auth::id(),
            'loan_id' => $loanId,
            'action' => $action,
            'level' => $level,
            'details' => $details,
            'ip_address' => Request::ip()
        ]);
    }
}