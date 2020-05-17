<?php

use Illuminate\Database\Seeder;
use App\VisitIn;

class VisitInSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(VisitIn::class,31)->create();   
    }
}
