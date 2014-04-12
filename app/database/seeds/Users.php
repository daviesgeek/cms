<?php

class Users extends Seeder {

    public function run()
    {
        DB::table('user')->delete();

        DB::table('user')->insert(
          array(
            'id' => '1',
            'email' => 'daviesgeek@gmail.com',
            'username' => 'daviesgeek',
            'password' => '$2y$10$b7T0N4UH6EDMGo40qlCc1OgW7.8YJFm3dU0nnoSAH8e1avpxM/glu',
            'activated' => 1,
            'first_name' => 'Matthew',
            'last_name' => 'Davies',
            'created_at' => '2014-04-05 23:24:54'
          )
        );
    }

}