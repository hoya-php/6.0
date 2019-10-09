<?php

use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');
        // 固定ユーザーを作成

        for($i=0; $i<10; $i++)
        {

            DB::table('members')->insert([

                'name'  => $faker->name,
                'group_id' => 1,
                'type' => '',
                'year' => 2019,
                'month' => 10,
                'day_1' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_2' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_3' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_4' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_5' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_6' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_7' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_8' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_9' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_10' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_11' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_12' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_13' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_14' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_15' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_16' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_17' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_18' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_19' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_20' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_21' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_22' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_23' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_24' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_25' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_26' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_27' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_28' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_29' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_30' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'day_31' => $faker->randomElement($array = ['日勤', '徹夜','夜勤',""]),
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),

            ]);

        };
    }
}
