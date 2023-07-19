<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CmsPage;

class CmsPageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $cmsRecords =[
            ['id'=>1,'title'=>'About Us','description'=>'This Page Load Coming Soon !',
            'url'=>'about-us',
            'meta_title'=>'About Us','meta_description'=>'About Us page Content is Coming Soon',
            'meta_keywords'=>'about us,about','status'=>1
        ],
         ['id'=>2,'title'=>'Terms & Conditions','description'=>'This Page Load Coming Soon !',
         'url'=>'terms-conditions',
            'meta_title'=>'terms-conditions','meta_description'=>'Terms & Conditions Content',
            'meta_keywords'=>'terms-Conditions,terms','status'=>1
        ],
          ['id'=>3,'title'=>'Privacy policy','description'=>'This Page Load Coming Soon !',
          'url'=>'privacy-policy',
            'meta_title'=>'Privacy policy','meta_description'=>'Privacy policy',
            'meta_keywords'=>'Privacy policy','status'=>1
        ],
    ];
    CmsPage::insert($cmsRecords);
    }
}
