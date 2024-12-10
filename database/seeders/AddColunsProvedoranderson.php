<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class AddColunsProvedoranderson extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::table('games_keys', function (Blueprint $table) {
            $table->string('provedoranderson_url')->nullable();
            $table->string('provedoranderson_secret')->nullable();
            $table->string('provedoranderson_code')->nullable();
            $table->string('provedoranderson_token')->nullable();

        });
    }
}
