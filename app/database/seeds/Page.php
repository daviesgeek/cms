<?php

class Page extends Seeder {

    public function run()
    {
        DB::table('page')->delete();

        DB::table('page')->insert(
          array(
            array(
              'id'        => 1,
              'parent_id' => 0,
              'name'      => 'Home',
              'url'       => '/',
              'h1'        => 'Home',
              'title'     => 'Home',
              'template_id'  => 1,
              'active'    => 1,
              'locked'    => 1,
              'hidden'    => 1
            ),
            array(
              'id'        => 2,
              'parent_id' => 0,
              'name'      => 'Login',
              'url'       => 'login',
              'h1'        => 'Login',
              'title'     => 'Login',
              'template_id'  => 1,
              'active'    => 1,
              'locked'    => 1,
              'hidden'    => 1
            )
          )
        );
    }

}