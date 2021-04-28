<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = collect(['Laravel', 'Vue Js', 'React Js']);
        $subjects->each(function($s) {
            Subject::create([
                'name' => $s,
                'slug' => Str::slug($s)
            ])
        });
    }
}
