<?php

use App\MediaExtension;
use Illuminate\Database\Seeder;

class MediaExtensionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MediaExtension::create([
            'name' => 'png',
         ]);

         MediaExtension::create([
            'name' => 'jpg',
         ]);

         MediaExtension::create([
            'name' => 'jpeg',
         ]);
    }
}
