<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use File;
use App\Models\Admin\PageCategory;
use Illuminate\Support\Facades\Date;

class PageCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catesData = File::get('components/database/contents/pagecategory.json');
        $cates = json_decode($catesData);

        $categoryInserts = [];
        $currentTimestamp = Date::now()->format('Y-m-d H:i:s');

        foreach ($cates as $cate) {
            $categoryInserts[] = [
                "id"          => $cate->id,
                "title"       => $cate->title,
                "description" => $cate->description,
                "sort"        => $cate->sort,
                "align"       => $cate->align,
                "background"  => $cate->background,
                "created_at"  => $currentTimestamp,
                "updated_at"  => $currentTimestamp
            ];
        }

        // Insert all the categories in a single query
        PageCategory::insert($categoryInserts);
    }
}
