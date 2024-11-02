<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use File;
use App\Models\Admin\AuthPages;
use Illuminate\Support\Facades\Date;

class AuthPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authpages = File::get('components/database/contents/authpages.json');

        $authpages = json_decode($authpages);
        
        foreach ($authpages as $authpage) {

          AuthPages::create([
            "id"         => $authpage->id,
            "name"       => $authpage->name,
            "status"     => $authpage->status,
            "created_at" => Date::now(),
            "updated_at" => Date::now()
          ]);
          
        }
    }
}
