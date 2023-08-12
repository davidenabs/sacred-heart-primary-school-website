<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'school_name' => 'Sacred Heart Primary School.',
            'about_school' => "One of the standout features of Sacred Heart Primary School is its commitment to personalized attention and student support. With excellent class sizes, teachers can provide individualized instruction and guidance, ensuring that each student's unique needs and learning styles are addressed.",
            'phone_number' => '+23480 6071 7501',
            'school_email' => 'sacredheartprimaryschool2023@gmail.com',
            'school_address' => '46 independence way Kaduna, Kaduna State'
        ]);

    }
}




