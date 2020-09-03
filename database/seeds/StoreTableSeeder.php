<?php

use Illuminate\Database\Seeder;

class StoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $stores = \App\Store::All();

        foreach($stores as $s){
            $s->products()->save(factory(\App\Product::class)->make());
        }
    }
}
