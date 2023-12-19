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
        Schema::create('trailer_documents', function (Blueprint $table) {
            $table->uuid('trailer_document_id')->primary();
            $table->foreignUuid('trailer_id')->constrained('trailers', 'trailer_id');
            $table->foreignId('document_id')->constrained('documents', 'document_id');
            $table->string('file_name', 255);
            $table->string('file_path', 255);
            $table->date('valid_until')->nullable();
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->foreignUuid('created_by')->nullable()->constrained('users', 'user_id');
            $table->foreignUuid('updated_by')->nullable()->constrained('users', 'user_id');
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
        Schema::dropIfExists('trailer_documents');
    }
};
