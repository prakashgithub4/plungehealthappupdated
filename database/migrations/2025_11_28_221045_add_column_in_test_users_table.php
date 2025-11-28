<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInTestUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lab_test_users', function (Blueprint $table) {

            $table->id();
            // TEST ID FK
            $table->unsignedBigInteger('test_id')
                ->nullable();

            $table->foreign('test_id')
                ->references('id')
                ->on('lab_tests')
                ->onDelete('cascade');

            // EXTRA FIELDS
            $table->string('test_date')->nullable();


            $table->string('patient_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lab_test_users', function (Blueprint $table) {

            $table->dropForeign(['test_id']);

            // DROP Columns
            $table->dropColumn(['lab_id', 'test_id', 'test_date', 'patient_id']);
        });
    }
}
