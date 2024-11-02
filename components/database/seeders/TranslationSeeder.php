<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Translations;
use File;
use Illuminate\Support\Facades\Date;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $translationsData = File::get('components/database/contents/translations.json');
        $translations = json_decode($translationsData);

        $translationInserts = [];
        $currentTimestamp = Date::now()->format('Y-m-d H:i:s');

        foreach ($translations as $translation) {
            $translationInserts[] = [
                "id"         => $translation->id,
                "key"        => $translation->key,
                "value"      => $translation->value,
                "lang_id"    => $translation->lang_id,
                "created_at" => $currentTimestamp,
                "updated_at" => $currentTimestamp
            ];
        }

        // Insert all the translations in a single query
        Translations::insert($translationInserts);
    }
}
