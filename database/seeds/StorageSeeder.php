<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class StorageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::makeDirectory('resumes');
        Storage::makeDirectory('reports');
    }
}
