<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Hash;
class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $password = Hash::make('password');
        $adminrecord =[
        ['id'=>2,
             'name' =>'userB',
             'type'=>'HR',
             'mobile'=>9109059704,
             'email'=>'adminb@admin.com',
             'password'=>$password,
             'image'=>'',
             'status'=>1
    ],
        ['id'=>3,
             'name' =>'userC',
             'type'=>'manager',
             'mobile'=>9109059704,
             'email'=>'adminc@admin.com',
             'password'=>$password,
             'image'=>'',
             'status'=>1
        ]
        ];
        Admin::insert($adminrecord);


    }
}
