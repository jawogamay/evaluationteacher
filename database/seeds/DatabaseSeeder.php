<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // ADMIN

        App\Admin::create([
            'fname' => 'Admin',
            'lname' => 'Admin',
            'username' => 'admin1234',
            'password' => Hash::make('secret')
        ]);

        // POSITIONS

        App\Position::create([
            'pos_name' => 'Teacher'
        ]);

        App\Position::create([
            'pos_name' => 'Dean'
        ]);

        App\Position::create([
            'pos_name' => 'Chairman'
        ]);

        // SECTIONS

        App\Section::create([
            'sec_code' => 'IT1A Day'
        ]);

        App\Section::create([
            'sec_code' => 'IT1B Day'
        ]);

        App\Section::create([
            'sec_code' => 'IT1A Eve'
        ]);

        App\Section::create([
            'sec_code' => 'IT1B Eve'
        ]);

        // QUESTIONS

        App\Question::create([
            'ques_category' => 'Commitment',
            'ques_statement' => 'Demonstrates sensitivity to students ability to attend and
            absorb content'
        ]);

        App\Question::create([
            'ques_category' => 'Knowledge of the Subject',
            'ques_statement' => 'Draws and share information on the state of the art of the
            theory and practice in his/her discipline.'
        ]);

        App\Question::create([
            'ques_category' => 'Teaching Effectiveness',
            'ques_statement' => 'Creates teaching strategies that allow students to practice
            using concepts they need to understand (interactive
            discussion).'
        ]);

        App\Question::create([
            'ques_category' => 'Management of Learning',
            'ques_statement' => 'Creates opportunities for intensive and/or extensive
            contribution of students in the class activities (e.g. breaks
            class into dyads, triads or task groups).'
        ]);
    }
}
