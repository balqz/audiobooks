<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);
        factory(App\User::class, 100)->create();

        factory(App\Category::class, 10)->create()->each(function ($c) {
            $c->audiobooks()->save(factory(App\AudioBook::class)->make());
        });

        Model::reguard();
    }
}
