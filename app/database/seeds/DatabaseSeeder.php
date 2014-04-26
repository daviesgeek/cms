<?php
class DatabaseSeeder extends Seeder {

    public function run()
    {
        $this->call('EditSection');
        $this->command->info('edit sections seeded!');
        
        $this->call('Groups');
        $this->command->info('groups seeded!');

        $this->call('Page');
        $this->command->info('pages seeded!');

        $this->call('Templates');
        $this->command->info('templates seeded!');

        $this->call('UserGroups');
        $this->command->info('user groups seeded!');

        $this->call('Users');
        $this->command->info('users seeded!');

    }

}
