<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Languages;
use File;
use Illuminate\Support\Facades\Date;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languagesData = File::get('components/database/contents/languages.json');
        $languages = json_decode($languagesData);

        $insertData = [];
        $currentTimestamp = Date::now()->format('Y-m-d H:i:s');

        foreach ($languages as $language) {
            $insertData[] = [
                "id"         => $language->id,
                "name"       => $language->name,
                "code"       => $language->code,
                "default"    => $language->default,
                "status"     => true,
                "created_at" => $currentTimestamp,
                "updated_at" => $currentTimestamp
            ];
        }

        Languages::insert($insertData);
    }
}
