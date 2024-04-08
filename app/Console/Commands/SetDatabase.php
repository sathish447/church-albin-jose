<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $DB_DATABASE = $this->ask('enter database name');
        $DB_USERNAME = $this->ask('enter username');
        $DB_PASSWORD = $this->ask('enter password');

        $set = [
            "DB_DATABASE" => $DB_DATABASE,
            "DB_USERNAME" => $DB_USERNAME,
            "DB_PASSWORD" => $DB_PASSWORD,
        ];

        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        foreach ($set as $key => $value) {
            $newLine = "{$key}=".$value;

              foreach (preg_split("/((\r?\n)|(\r\n?))/", $str) as $line) {
                if (stripos($line, "{$key}=") === 0) {
                    $str = str_replace($line, $newLine, $str);
                }
            }
        }

        $fp = fopen($envFile, 'w');
        fwrite($fp, $str);
        fclose($fp);

        $this->info("Credentials Updated");
        $this->call('optimize:clear');
    }
}
