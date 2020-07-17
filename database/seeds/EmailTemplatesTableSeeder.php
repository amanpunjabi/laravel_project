<?php

use Illuminate\Database\Seeder;
use App\EmailTemplates;
class EmailTemplatesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $email = new EmailTemplates();
        $email->slug = "forgot_password";
        $email->subject = "Forgot Password";
        $email->message = "";
        $email->save();

        $email = new EmailTemplates();
        $email->slug = "reset_password";
        $email->subject = "Reset Password";
        $email->message = "";
        $email->save();

    }
}