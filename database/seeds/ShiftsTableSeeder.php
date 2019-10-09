<?php

use Illuminate\Database\Seeder;

class ShiftsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fakerを使う
        $faker = Faker\Factory::create('ja_JP');

        // ランダムに記事を作成

        DB::table('shifts')->insert([
        'name' => "日勤",
        'group_id' => '1',
        'shift_id' => '1',
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
        ]);

        DB::table('shifts')->insert([
            'name' => "徹夜",
            'group_id' => '1',
            'shift_id' => '2',
            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime(),
        ]);

        DB::table('shifts')->insert([
            'name' => "夜勤",
            'group_id' => '1',
            'shift_id' => '3',
            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime(),
        ]);

    }
}
