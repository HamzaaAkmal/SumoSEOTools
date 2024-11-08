<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generals', function (Blueprint $table) {
            $table->id();
            $table->boolean('parallax_status')->default(true);
            $table->text('parallax_image')->nullable();
            $table->text('overlay_type')->nullable();
            $table->text('solid_color')->nullable();
            $table->text('gradient_first_color')->nullable();
            $table->text('gradient_second_color')->nullable();
            $table->text('gradient_position')->nullable();
            $table->text('opacity')->nullable();
            $table->text('blur')->nullable();
            $table->text('font_family')->nullable();
            $table->text('font_style')->nullable();
            $table->text('prefix')->nullable();
            $table->string('file_size')->default(5);
            $table->text('timezone')->nullable();
            $table->text('default_language')->nullable();
            $table->text('main_color')->nullable();
            $table->boolean('maintenance_mode')->default(true);
            $table->boolean('theme_mode')->default(true);
            $table->boolean('dir_mode')->default(true);
            $table->boolean('adblock_detection')->default(true);
            $table->boolean('automatic_language_detection')->default(true);
            $table->boolean('language_switcher')->default(true);
            $table->boolean('page_load')->default(true);
            $table->boolean('back_to_top')->default(true);
            $table->boolean('share_icons_status')->default(true);
            $table->boolean('search_box_status')->default(true);
            $table->boolean('blog_page_status')->default(true);
            $table->string('blog_page_count')->default(6);
            $table->boolean('related_tools')->default(true);
            $table->string('related_tools_count')->default(6);
            $table->string('related_tools_background')->default('bg-gradient-primary');
            $table->boolean('author_box_status')->default(true);
            $table->boolean('social_status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('generals');
    }
}
