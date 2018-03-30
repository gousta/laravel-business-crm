<?php

namespace App\Console\Assets;

use Illuminate\Console\Command;

class Version extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assets:version';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets a version for assets (js/css).';

    /**
     * Create a new command instance.
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
        $key = md5(time());

        $this->setKeyInEnvironmentFile($key);
        $this->laravel['config']['assets.version'] = $key;
        $this->info("Assets version [$key] set successfully.");
    }

    /**
     * Set the version hash in the environment file.
     *
     * @param string $hash
     *
     * @return void
     */
    protected function setKeyInEnvironmentFile($key)
    {
        file_put_contents($this->laravel->environmentFilePath(), str_replace(
            'ASSETS_VERSION='.$this->laravel['config']['assets.version'],
            'ASSETS_VERSION='.$key,
            file_get_contents($this->laravel->environmentFilePath())
        ));
    }
}
