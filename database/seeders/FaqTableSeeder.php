<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('faq')->insert([
            [
                'user_id' => 1,  // Ensure this user exists in the users table
                'faq_question' => 'How do I contribute a document?',
                'faq_answer' => 'To contribute a document, click on the "Contribute" button and follow the instructions.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,  // Ensure this user exists in the users table
                'faq_question' => 'How do I report a document?',
                'faq_answer' => 'You can report a document by clicking on the "Report" button next to the document.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,  // Ensure this user exists in the users table
                'faq_question' => 'How do I rate a document?',
                'faq_answer' => 'To rate a document, go to the document page and select the number of stars you want to give.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 4,  // Ensure this user exists in the users table
                'faq_question' => 'How do I search for a specific document?',
                'faq_answer' => 'You can use the search bar located at the top of the page to search by document name, tags, or keywords.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 5,  // Ensure this user exists in the users table
                'faq_question' => 'What happens if my document is reported?',
                'faq_answer' => 'If your document is reported, it will be reviewed by a moderator and may be removed if it violates our terms.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 6,  // Ensure this user exists in the users table
                'faq_question' => 'How do I contact support?',
                'faq_answer' => 'You can contact support by emailing support@share2teach.com on our website.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
