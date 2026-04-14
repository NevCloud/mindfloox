<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class instructorsController extends Controller
{
    public function instructors()
    {
        $instructors = [
            [
                'name' => 'Sarah Johnson',
                'field' => 'Web Development',
                'students' => '2.1k',
                'rating' => 4.8,
                'totalCourses' => 18,
                'image' => 'img/momo.png',
            ],
            [
                'name' => 'Alex Rivera',
                'field' => 'UI/UX Design',
                'students' => '1.5k',
                'rating' => 4.9,
                'totalCourses' => 18,
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d',
            ],
            [
                'name' => 'Jessica Chen',
                'field' => 'Data Science',
                'students' => '3.4k',
                'rating' => 4.7,
                'totalCourses' => 12,
                'image' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330',
            ],
            [
                'name' => 'Budi Santoso',
                'field' => 'Digital Marketing',
                'students' => '950',
                'rating' => 5.0,
                'totalCourses' => 7,
                'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e',
            ],
        ];
        return view('instructors', compact('instructors'));
    }
}
