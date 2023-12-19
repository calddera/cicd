<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('truck_tags', function (Blueprint $table) {
            $table->id('truck_tag_id');
            $table->foreignUuid('truck_id')->constrained('trucks', 'truck_id');
            $table->string('tag_name', 255);
            $table->date('valid_until')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('truck_tags');
    }
};
