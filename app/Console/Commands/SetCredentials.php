<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetCredentials extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:credentials';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set Credentials in ENV';

    /**
     * Clear all cache
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info("1. Set DB, 2. Set MAIL");
        $option = $this->ask("Enter Option");

        $set = [];

        if ($option == 1) {
            $DB_DATABASE = $this->ask("DB DATABASE");
            $DB_USERNAME = $this->ask("DB USERNAME");
            $DB_PASSWORD = $this->ask("DB PASSWORD");

            $set = [
                "DB_DATABASE" => $DB_DATABASE,
                "DB_USERNAME" => $DB_USERNAME,
                "DB_PASSWORD" => $DB_PASSWORD,
            ];
        } elseif ($option == 2) {
            $MAIL_HOST = $this->ask("MAIL HOST");
            $MAIL_PORT = $this->ask("MAIL PORT");
            $MAIL_USERNAME = $this->ask("MAIL USERNAME");
            $MAIL_PASSWORD = $this->ask("MAIL PASSWORD");
            $MAIL_ENCRYPTION = $this->ask("MAIL ENCRYPTION");
            $MAIL_FROM_ADDRESS = $this->ask("MAIL FROM ADDRESS");

            $set = [
                "MAIL_HOST" => $MAIL_HOST,
                "MAIL_PORT" => $MAIL_PORT,
                "MAIL_USERNAME" => $MAIL_USERNAME,
                "MAIL_PASSWORD" => $MAIL_PASSWORD,
                "MAIL_ENCRYPTION" => $MAIL_ENCRYPTION,
                "MAIL_FROM_ADDRESS" => $MAIL_FROM_ADDRESS,
            ];
        } 
        else {
            $this->info("Invalid Option");
            die();
        }

        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        foreach ($set as $key => $value) {
            $new_line = "{$key}=" . $value;

            foreach (preg_split("/((\r?\n)|(\r\n?))/", $str) as $line) {
                if (stripos($line, "{$key}=") === 0) {
                    $str = str_replace($line, $new_line, $str);
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
