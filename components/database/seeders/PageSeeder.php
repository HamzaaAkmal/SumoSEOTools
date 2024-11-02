<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Page;
use App\Models\Admin\PageTranslation;
use File;
use Illuminate\Support\Facades\Date;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pagesData              = File::get('components/database/contents/pages.json');
        $pages                  = json_decode($pagesData);

        $pageInserts            = [];
        $pageTranslationInserts = [];
        $currentTimestamp       = Date::now()->format('Y-m-d H:i:s');

        foreach ($pages as $page) {

            $pageData = [
                "id"               => $page->id,
                "slug"             => $page->slug,
                "type"             => $page->type,
                "position"         => $page->position,
                "featured_image"   => asset('assets/img/nastuh.jpg'),
                "tool_name"        => null,
                "icon_image"       => null,
                "ads_status"       => $page->ads_status,
                "popular"          => $page->popular,
                "category_id"      => null,
                "post_status"      => true,
                "page_status"      => true,
                "tool_status"      => true,
                "custom_tool_link" => $page->custom_tool_link,
                "created_at"       => $currentTimestamp,
                "updated_at"       => $currentTimestamp
            ];

            if ($page->type == 'tool') {
                $pageData['tool_name']   = $page->tool_name;
                $pageData['icon_image']  = asset('assets/img/tools/' . $page->icon_image);
                $pageData['category_id'] = $page->category_id;
            }

            $pageInserts[] = $pageData;

            foreach ($page->translations as $pageTran) {
                $pageTranslationInserts[] = [
                    "locale"            => $pageTran->locale,
                    "sitename_status"   => $pageTran->sitename_status,
                    "page_title"        => $pageTran->page_title,
                    "title"             => $pageTran->title,
                    "subtitle"          => $pageTran->subtitle ?? '',
                    "short_description" => $pageTran->title,
                    "description"       => '',
                    "page_id"           => $page->id
                ];
            }
        }

        // Insert all the pages in a single query
        Page::insert($pageInserts);

        // Insert all the page translations in a single query
        PageTranslation::insert($pageTranslationInserts);
    }
}