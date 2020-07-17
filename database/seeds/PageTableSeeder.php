<?php

use Illuminate\Database\Seeder;
use App\Cms;
class PageTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $page = new Cms();
        $page->name = "privacy-policy";
        $page->slug = "privacy-policy";
        $page->title = "Privacy And Policy";
        $page->description = "";
        $page->save();

        $page = new Cms();
        $page->name = "terms and condition";
        $page->slug = "terms-and-conditions";
        $page->title = "Terms And Conditions";
        $page->description = "";
        $page->save();
        

        $page = new Cms();
        $page->name = "about";
        $page->slug = "about";
        $page->title = "About Us";
        $page->description = "";
        $page->save();


        $page = new Cms();
        $page->name = "refund-policy";
        $page->slug = "refund-policy";
        $page->title = "Refund Policy";
        $page->description = "";
        $page->save();

        $page = new Cms();
        $page->name = "billing-system";
        $page->slug = "billing-system";
        $page->title = "Billing System";
        $page->description = "";
        $page->save();

        $page = new Cms();
        $page->name = "ticket-system";
        $page->slug = "ticket-system";
        $page->title = "Ticket System";
        $page->description = "";
        $page->save();

        $page = new Cms();
        $page->name = "store-location";
        $page->slug = "store-location";
        $page->title = "Store Location";
        $page->description = "";
        $page->save();


        $page = new Cms();
        $page->name = "career";
        $page->slug = "career";
        $page->title = "Career";
        $page->description = "";
        $page->save();

        $page = new Cms();
        $page->name = "copywrite";
        $page->slug = "copywrite";
        $page->title = "Copywrite";
        $page->description = "";
        $page->save();
 
    }
}