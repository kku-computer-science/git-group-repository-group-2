<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SelectDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'serve:db {--reset : Reset .env to default settings}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Select a database before running the server or reset the .env file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->option('reset')) {
            $this->resetEnvironmentFile();
            $this->info('The .env file has been reset to default settings.');
            return 0;
        }


        $databases = [
            'DBtest1' => 'DBtest1',
            'NewDB' => 'NewDB',
            'Production' => 'Production',
        ];


        $choice = $this->choice(
            'Select the database to use',
            array_keys($databases)
        );

        $dbName = $databases[$choice];
        $this->updateEnvironmentFile('DB_DATABASE', $dbName);
        $this->info("Database switched to: {$dbName}");
        $this->call('serve');
        return 0;
    }

    /**
     * Update the .env file with the selected database.
     *
     * @param string $key
     * @param string $value
     */
    protected function updateEnvironmentFile($key, $value)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            file_put_contents(
                $path,
                preg_replace(
                    "/^{$key}=.*$/m",
                    "{$key}={$value}",
                    file_get_contents($path)
                )
            );
        }
    }

    /**
     * Reset the .env file to its default state.
     */
    protected function resetEnvironmentFile()
    {
        $path = base_path('.env');
        $backupPath = base_path('.env.example');

        if (file_exists($path) && file_exists($backupPath)) {
            copy($backupPath, $path);
        }
    }
}