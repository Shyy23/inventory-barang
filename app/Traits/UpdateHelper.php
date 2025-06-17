<?php 

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait UpdateHelper
{
    protected function buildCaseStatement(array $updates, string $column){
        $case = "CASE {$column} ";
        foreach ($updates as $id => $value) {
            $safeValue = DB::getPdo()->quote($value);
            $case .= "WHEN  {$id} THEN {$safeValue} ";
        }
        $case .= "END";
        return DB::raw($case);
    }
}