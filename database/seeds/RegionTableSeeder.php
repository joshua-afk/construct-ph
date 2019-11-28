<?php

use Illuminate\Database\Seeder;
use App\Region;

class RegionTableSeeder extends Seeder
{
	public function run()
	{
		Region::insert([
			[
				'id' => 1,
				'name' => 'Autonomous Region in Muslim Mindanao',
				'code' => 'ARMM'
			],
			[
				'id' => 2,
				'name' => 'Cordillera Administrative Region',
				'code' => 'CAR'
			],
			[
				'id' => 3,
				'name' => 'National Capital Region',
				'code' => 'NCR'
			],
			[
				'id' => 4,
				'name' => 'Ilocos Region',
				'code' => 'Region 1'
			],
			[
				'id' => 5,
				'name' => 'Cagayan Valley',
				'code' => 'Region 2'
			],
			[
				'id' => 6,
				'name' => 'Central Luzon',
				'code' => 'Region 3'
			],
			[
				'id' => 7,
				'name' => 'CALABARZON',
				'code' => 'Region 4A'
			],
			[
				'id' => 8,
				'name' => 'MIMAROPA',
				'code' => 'Region 4B'
			],
			[
				'id' => 9,
				'name' => 'Bicol Region',
				'code' => 'Region 5'
			],
			[
				'id' => 10,
				'name' => 'Western Visayas',
				'code' => 'Region 6'
			],
			[
				'id' => 11,
				'name' => 'Central Visayas',
				'code' => 'Region 7'
			],
			[
				'id' => 12,
				'name' => 'Eastern Visayas',
				'code' => 'Region 8'
			],
			[
				'id' => 13,
				'name' => 'Zamboanga Peninsula',
				'code' => 'Region 9'
			],
			[
				'id' => 14,
				'name' => 'Northern Mindanao',
				'code' => 'Region 10'
			],
			[
				'id' => 15,
				'name' => 'Davao Region',
				'code' => 'Region 11'
			],
			[
				'id' => 16,
				'name' => 'SOCCSKSARGEN',
				'code' => 'Region 12'
			],
			[
				'id' => 17,
				'name' => 'Caraga Region',
				'code' => 'Region 13'
			],
		]);
	}
}
