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

        $config = new Configuration();
        $config->key_name = "phone";
        $config->title = "Phone";
        $config->value = "98989898";
        $config->save();

        $config = new Configuration();
        $config->key_name = "facebook";
        $config->title = "Facebook";
        $config->value = "";
        $config->save();

        $config = new Configuration();
        $config->key_name = "twitter";
        $config->title = "Twitter";
        $config->value = "";
        $config->save();

        $config = new Configuration();
        $config->key_name = "linkedin";
        $config->title = "LinkedIn";
        $config->value = "";
        $config->save();

    }
} 