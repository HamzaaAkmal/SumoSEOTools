<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Advanced;
use Illuminate\Support\Facades\Date;

class AdvancedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Advanced::create([
            "id"            => 1,
            "insert_header" => null,
            "header_status" => false,
            "insert_footer" => null,
            "footer_status" => false,
            "created_at"    => Date::now(),
            "updated_at"    => Date::now()
          ]);
    }
}
