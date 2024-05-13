<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin();
        $admin->first_name = 'Norddine';
        $admin->last_name = 'ihichr';
        $admin->username = 'admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('123456789');
        $admin->picture = 'no_image.png';
        $admin->save();
    }
}
