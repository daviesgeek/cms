<?php

class Groups extends Seeder {

    public function run()
    {
        DB::table('group')->delete();

        DB::table('group')->insert(
          array(
            'id' => 1,
            'name' => 'Administrators',
            'permissions' => '{
                "admin":1,
                "admin.home":1
                }',
            'created_at' => '2014-04-05 23:48:45'
          )
        );
    }

}