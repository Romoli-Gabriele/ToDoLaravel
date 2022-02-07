<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('cognome');
            $table->string('indirizzo')->nullable();
            $table->string('codice_fiscale')->nullable();
            $table->string('cellulare');
            $table->string('sede')->nullable();
            $table->foreignId('user_id');
            $table->date('ddn')->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
