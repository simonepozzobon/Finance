<?php

use Illuminate\Database\Seeder;

class EmailSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('email_settings')->truncate();
        DB::table('email_settings')->insert([
          'server'    => 'imap.gmail.com',
          'port'      => 993,
          'ssl'       => true,
          'in_folder' => 'INBOX',
          'user'      => 'h57.milano@gmail.com',
          'password'  => Hash::make('Tarantin0'),
        ]);
    }
}
