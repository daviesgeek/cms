<?php

class UserGroups extends Seeder {

    public function run()
    {
        DB::table('user_group')->delete();

        DB::table('user_group')->insert(
          array(
            'user_id' => 1,
            'group_id' => 1
          )
        );
    }

}