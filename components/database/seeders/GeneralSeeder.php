<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\General;
use Illuminate\Support\Facades\Date;

class GeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          General::create([
            "id"                           => 1,
            "parallax_status"              => true,
            "parallax_image"               => asset('assets/img/parallax.jpg'),
            "overlay_type"                 => "gradient",
            "solid_color"                  => "#ed3269",
            "gradient_first_color"         => "#5e72e4",
            "gradient_second_color"        => "#825ee4",
            "gradient_position"            => "to left",
            "opacity"                      => "0.9",
            "blur"                         => "1",
            "font_family"                  => "Open Sans",
            "font_style"                   => "regular",
            "prefix"                       => "SumoSEOTools_",
            "file_size"                    => "5",
            "timezone"                     => "UTC",
            "default_language"             => "en",
            "main_color"                   => "#cb0c9f",
            "maintenance_mode"             => false,
            "theme_mode"                   => true,
            "dir_mode"                     => 1,
            "adblock_detection"            => true,
            "automatic_language_detection" => false,
            "language_switcher"            => true,
            "page_load"                    => true,
            "lazy_loading"                 => 1,
            "back_to_top"                  => 1,
            "share_icons_status"           => true,
            "search_box_status"            => true,
            "blog_page_status"             => true,
            "blog_page_count"              => "6",
            "heading_background"           => "bg-gradient-primary",
            "related_tools"                => true,
            "related_tools_count"          => "6",
            "related_tools_background"     => "bg-gradient-primary",
            "author_box_status"            => true,
            "social_status"                => true,
            "created_at"                   => Date::now(),
            "updated_at"                   => Date::now()

          ]);
    }
}
