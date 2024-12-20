<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Sidebar;
use Illuminate\Support\Facades\Date;

class SidebarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Sidebar::create([
            "id"              => 1,
            "post_status"     => true,
            "post_count"      => 6,
            "post_align"      => 'start',
            "post_background" => 'bg-gradient-primary',
            "tool_status"     => true,
            "tool_align"      => 'start',
            "tool_background" => 'bg-gradient-primary',
            "created_at"      => Date::now(),
            "updated_at"      => Date::now()
          ]);
    }
}
