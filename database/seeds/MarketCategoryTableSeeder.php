<?php

use App\Market;
use Illuminate\Database\Seeder;

class MarketCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Now attach categories
        $br = Market::find(1);
        $br->categories()->attach([1,2,3,4,5]);

        $sm = Market::find(10);
        $sm->categories()->attach([1,2,3,4,5]);

        $gs = Market::find(2);
        $gs->categories()->attach([1,2,3,5]);

        $ho = Market::find(3);
        $ho->categories()->attach([1,2,3,5]);

        $ob = Market::find(4);
        $ob->categories()->attach([1,2,3,5]);

        $oc = Market::find(5);
        $oc->categories()->attach([1,2,3,5]);

        $rh = Market::find(6);
        $rh->categories()->attach([1,2,3,5]);

        $sa = Market::find(7);
        $sa->categories()->attach([1,2,3,5]);

        $sc = Market::find(8);
        $sc->categories()->attach([1,2,3,5]);

        $vb = Market::find(9);
        $vb->categories()->attach([1,2,3,5]);

        $cg = Market::find(11);
        $cg->categories()->attach([1,2,3,5]);
    }
}
