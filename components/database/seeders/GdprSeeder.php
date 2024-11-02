<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Gdpr;
use Illuminate\Support\Facades\Date;

class GdprSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Gdpr::create([
            "id"         => 1,
            "notice"     => "We use cookies to ensure that we give you the best experience on our website. If you continue to use this site we will assume that you are happy with it.",
            "align"      => "text-left",
            "background" => "bg-gradient-info",
            "button"     => 1,
            "status"     => true,
            "created_at" => Date::now(),
            "updated_at" => Date::now()
          ]);
    }
}
