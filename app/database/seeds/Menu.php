<?php

class Menu extends Seeder {

    public function run()
    {
        DB::table('menu')->delete();

        DB::table('menu')->insert(
          array(
            array(
              'id' => 1,
              'parentID' => 0,
              'name' => 'Home',
              'url' => '/',
              'h1' => 'Home',
              'template' => 1,
              'active' => 1,
              'locked' => 1
            ),
            array(
              'id' => 2,
              'parentID' => 0,
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