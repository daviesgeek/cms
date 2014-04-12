<?php

class Templates extends Seeder {

    public function run()
    {
        DB::table('template')->delete();

        DB::table('template')->insert(
          array(
            'id' => 1,
            'name' => 'main'
          )
        );
    }

}