<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Backup\Tasks\Backup\BackupJobFactory;

class BackupController extends Controller
{
    public function backup(){
        $backupJob = (new BackupJobFactory())->createFromArray(config('backup'));
        $backupJob->run();
        return 'Backup realizado con éxito.';
    }
}
