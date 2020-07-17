<?php

use Illuminate\Database\Seeder;
use App\Configuration;
class ConfigurationTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $config = new Configuration();
        $config->key_name = "email";
        $config->title = "Email";
        $config->value = "amanpunjabi61@gmail.com";
        $config->save();
    }
}