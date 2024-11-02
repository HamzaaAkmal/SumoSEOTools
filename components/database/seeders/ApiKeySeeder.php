<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\ApiKeys;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Date;

class ApiKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        $api_key = ApiKeys::create([
            "id"         => 1,
            "created_at" => Date::now()
        ]);

        $indexnow_api_key          = (string) Str::uuid();
        $indexnow_api_key          = str_replace('-', '', $indexnow_api_key);
        
        $api_key->indexnow_api_key = $indexnow_api_key;
        $api_key->updated_at       = Date::now();
        $api_key->save();
    }
}
