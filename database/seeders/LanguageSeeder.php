<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Db::table("languages")->insert([
            [
                "title" => "Türkçe",
                "code" => "tr",
                "status" => "active",
                "is_default" => true,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "title" => "English",
                "code" => "en",
                "status" => "active",
                "is_default" => false,
                "created_at" => now(),
                "updated_at" => now()
            ],
        ]);
    }
}
