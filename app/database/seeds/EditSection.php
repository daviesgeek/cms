<?php

class EditSection extends Seeder {

    public function run()
    {
        DB::table('edit_section')->delete();

        DB::table('edit_section')->insert(
          array(
            'id' => 1,
            'name' => 'main'
          )
        );
    }

}
