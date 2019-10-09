<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
        DB::table('users')->insert([
            'name' => 'hoya24',
            'email' => 'hogehuga@gmail.com',
            'group_id' => 1,
            'password' => bcrypt('1234'),
            'email_verified_at' => $faker->dateTime(),
            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime(),
        ]);
    }
}
