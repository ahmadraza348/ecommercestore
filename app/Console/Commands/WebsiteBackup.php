<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class WebsiteBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:website-backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Full website backup including database and files for Raza Mall';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting Raza Mall Backup...');

        // 1. Clean up logs manually (removes the log:clear error)
        $this->comment('Cleaning up logs...');
        $logPath = storage_path('logs');
        if (File::exists($logPath)) {
            $logFiles = File::files($logPath);
            foreach ($logFiles as $file) {
                if ($file->getExtension() === 'log') {
                    File::delete($file);
                }
            }
        }
        $this->info('Logs cleared.');

        // 2. Run Full Backup (Database + Files together in one ZIP)
        $this->comment('Running full backup (Database & Files)...');
        
        // Using $this->call lets you see the package's output in your terminal
        $result = $this->call('backup:run', [
            '--no-interaction' => true,
        ]);

        if ($result === 0) {
            $this->info('Backup completed successfully!');
            Log::info('Website backup completed successfully at ' . now());
        } else {
            $this->error('Backup failed! Check your spatie/laravel-backup configuration.');
            Log::error('Website backup failed at ' . now());
        }
    }
}