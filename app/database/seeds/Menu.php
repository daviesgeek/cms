<?php

class Menu extends Seeder {

    public function run()
    {
        DB::table('page')->delete();

        DB::table('page')->insert(
          array(
            array(
              'id' => 1,
              'parent_id' => 0,
              'name' => 'Home',
              'url' => '/',
              'h1' => 'Home',
              'template' => 1,
              'active' => 1,
              'locked' => 1
            ),
            array(
              'id' => 2,
              'parent_id' => 0,
              'name' => 'Login',
              'url' => 'login',
              'h1' => 'Login',
              'template' => 1,
              'active' => 1,
              'locked' => 1
            )
          )
        );
    }

}