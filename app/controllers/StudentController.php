<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: StudentController
 * 
 * Automatically generated via CLI.
 */
class StudentController extends Controller {

    public function index() {
        $_SESSION['student_access'] = true;
        $this->call->view('student_home');
    }

    public function profile() {
        $student = [
            'student_id' => 'MCC2024 - 00061',
            'name'       => 'Nico Adrian A. Catipan', 
            'course'     => 'BS Information Technology',
            'year'       => '3rd Year',
            'section'    => '3 - F2',
            'email'      => 'nicocatipan4@gmail.com',
            'skills'     => 'PHP, HTML, CSS, JavaScript',
            'hobbies'    => 'Football, Coding, Video Games, Billiards',
            'address'    => '55, Bonifacio St,. Ilaya, Calapan City, Oriental Mindoro, Philippines',
            'contact'    => '+63 993 923 9602',
        ];
        $this->call->view('student_profile', $student);
    }
}