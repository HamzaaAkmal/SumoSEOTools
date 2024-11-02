<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Menu;
use File;
use Illuminate\Support\Facades\Date;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menusData = File::get('components/database/contents/menus.json');
        $menus = json_decode($menusData);

        $menuInserts = [];
        $currentTimestamp = Date::now()->format('Y-m-d H:i:s');

        foreach ($menus as $menu) {
            $menuInserts[] = [
                "id"         => $menu->id,
                "text"       => $menu->text,
                "url"        => $menu->url,
                "menu_items" => $menu->menu_items,
                "icon"       => $menu->icon,
                "type"       => $menu->type,
                "class"      => $menu->class,
                "parent_id"  => $menu->parent_id,
                "sort"       => $menu->sort,
                "created_at" => $currentTimestamp,
                "updated_at" => $currentTimestamp
            ];
        }

        // Insert all the menus in a single query
        Menu::insert($menuInserts);
    }
}
