<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoulumnInLabTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lab_tests', function (Blueprint $table) {
            // Add column
            $table->unsignedBigInteger('lab_id')
                ->nullable()
                ->after('id');

            // Add foreign key constraint
            $table->foreign('lab_id')
                ->references('id')
                ->on('labs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lab_tests', function (Blueprint $table) {
            $table->dropForeign(['lab_id']);

            // Then drop the column
            $table->dropColumn('lab_id');
        });
    }
}
