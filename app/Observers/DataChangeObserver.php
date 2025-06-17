<?php

namespace App\Observers;

use App\Traits\Loggable;
use Exception;
use Illuminate\Support\Facades\Log;

class DataChangeObserver
{
    use Loggable;
    public function created($model)
    {
        try {
            $this->logDataChange(
                $model->getTable(),
                $model->getKey(),
                'create',
                'info',
                null,
                $model->toJson()
            );
        } catch (Exception $e) {
            $this->logObserverError($model, 'create', $e);
        }

    }
    public function updated($model)
    {
        try {
            $this->logDataChange(
                $model->getTable(),
                $model->getKey(),
                'update',
                'info',
                $model->getOriginal(),
                $model->getChanges()
            );
        } catch (Exception $e) {
            $this->logObserverError($model, 'update', $e);
        }

    }
    public function deleted($model)
    {
        try {
            $this->logDataChange(
                $model->getTable(),
                $model->getKey(),
                'delete',
                'warning',
                $model->getOriginal(),
                null
            );
        } catch (Exception $e) {
            $this->logObserverError($model, 'delete', $e);
        }

    }

    protected function logObserverError($model, string $action, Exception $exception)
    {
        Log::error("DataChangeObserver failed: {$action}", [
            'model' => get_class($model),
            'id' => $model->getKey(),
            'error' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString(),
        ]);

        $this->logSecurityEvent(
            'observer_failed',
            'error',
            false,
            null,
            [
                'action' => $action,
                'model' => get_class($model),
                'error' => $exception->getMessage()
            ]
        );
        // Send notification or email to admin
    }
}

