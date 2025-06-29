<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class createService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create new serivce class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $ServiceDirectory = app_path("Service/$name.php");
        if (file_exists($ServiceDirectory)) {
            $this->error("Service class already exists");
            return;
        }
        $ServiceContent =
            <<<php
        <?php
        namespace App\Service;
        class $name
        {
            //
        }
        php;

        file_put_contents($ServiceDirectory, $ServiceContent);
        $this->info("Service class created successfully");
        return;
    }
}
