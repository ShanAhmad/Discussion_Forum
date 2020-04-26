<?php

use Illuminate\Database\Seeder;
use App\Reply;
class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $r1=[
            'user_id'=>1,
            'discussion_id'=>1,
            'content'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
        ];
        $r2=[
            'user_id'=>1,
            'discussion_id'=>2,
            'content'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
        ];
        $r3=[
            'user_id'=>2,
            'discussion_id'=>3,
            'content'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
        ];

        Reply::create($r1);
        Reply::create($r2);
        Reply::create($r3);
    }
}
