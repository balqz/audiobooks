<?php

use App\Category;
use App\User;
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
            $c->audiobook()->saveMany(factory(App\AudioBook::class, 10)->create()->each(function ($d) {
                $d->audiobookChapter()->saveMany(factory(App\AudioBookChapter::class, 10)->create()->each(function ($chapter) use ($d) {
                    $chapter->purchase()->saveMany(factory(App\Purchase::class, 10)->create()->each(function ($purchase) use ($d, $chapter) {
                        $purchase->user_id = User::all()->random(1)->id;
                        $purchase->audiobookChapter_id = $chapter->id;
                        $purchase->audiobook_id = $d->id;
                    }));

                }));
                $d->review()->save(factory(App\Review::class)->make());
                $d->wishlist()->save(User::all()->random(1));
            }));
        });


        factory(App\Collection::class, 10)->create()->each(function ($c) {
            $c->audiobook()->saveMany(factory(App\AudioBook::class, 5)->create()->each(function ($d) {
                $d->category_id = Category::all()->random(1)->id;
            }));
        });

        Model::reguard();
    }
}
