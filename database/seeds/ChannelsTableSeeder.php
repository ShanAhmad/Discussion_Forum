<?php

use Illuminate\Database\Seeder;
use App\Channel;
class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channel1=['title'=>'Laravel','slug'=>str_slug('Laravel')];
        $channel2=['title'=>'nodejs','slug'=>str_slug('nodejs')];
        $channel3=['title'=>'Vuejs','slug'=>str_slug('Vuejs')];
        $channel4=['title'=>'javascript','slug'=>str_slug('javascript')];
        $channel5=['title'=>'java','slug'=>str_slug('java')];
        $channel6=['title'=>'express','slug'=>str_slug('express')];
        $channel7=['title'=>'Angular','slug'=>str_slug('Angular')];

        Channel::create($channel1);
        Channel::create($channel2);
        Channel::create($channel3);
        Channel::create($channel4);
        Channel::create($channel5);
        Channel::create($channel6);
        Channel::create($channel7);
    }
}
