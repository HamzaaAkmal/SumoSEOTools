<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Social;
use App\Models\Admin\UserSocial;
use File;
use Illuminate\Support\Facades\Date;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $socialsData = File::get('components/database/contents/socials.json');
        $socials = json_decode($socialsData);

        $socialInserts = [];
        $userSocialInserts = [];
        $currentTimestamp = Date::now()->format('Y-m-d H:i:s');

        foreach ($socials as $social) {
            $baseData = [
                "name"       => $social->name,
                "url"        => $social->url,
                "created_at" => $currentTimestamp,
                "updated_at" => $currentTimestamp
            ];
            
            $socialInserts[] = $baseData;

            $userSocialData = $baseData;
            $userSocialData["user_id"] = 1;

            $userSocialInserts[] = $userSocialData;
        }

        // Insert all the socials in a single query
        Social::insert($socialInserts);

        // Insert all the user socials in a single query
        UserSocial::insert($userSocialInserts);
    }
}
