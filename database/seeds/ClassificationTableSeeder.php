<?php

use Illuminate\Database\Seeder;
use App\Classification;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ClassificationTableSeeder extends Seeder
{
    public function run()
    {
      $uuid = (string) Str::uuid();

    	$classifications = ['Air-Conditioning and Refrigerator Work', 'Aluminum Work', 'Communication Facilities', 'Concrete Pre-casting and Pre-stress or Post-tensioning', 'Electrical Work', 'Electro-mechanical Work', 'Fire Protection Work', 'Foundation Work', 'General Building ', 'General Engineering', 'Industrial Instrumentation and Control', 'Landscaping', 'Mechanical Work', 'Metal Roofing and Siding Installation', 'N/A', 'Painting Work', 'Plumbing and Sanitary Work', 'Structural Steel Work', 'Trade', 'Water Proofing Work', 'Well Drilling Work', 'General Building', 'Waterproofing Work', 'Interior Design', 'Elevator and Escalator', 'Navigational Facilities', 'Air Navigation Facilities', 'Mill Wright', 'Guniting', 'Reinforce Earth', 'Slope Protection', 'Soil Stabilization', 'Power Generating Plants', 'Power Transmission and Distribution Facilities'
        ];

        foreach ($classifications as $value) {
          Classification::insert([
             'name'       => $value,
             'code'       => $uuid,
             'created_at' => Carbon::now('Asia/Manila'),
             'updated_at' => Carbon::now('Asia/Manila'),
         ]);
      }
  }
}
