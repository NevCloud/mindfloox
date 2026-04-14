<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class coursesController extends Controller
{
    public function courses()
    {
        $courses = [
            [
                'title' => 'Desain Grafis',
                'category' => 'DESIGN',
                'price' => 49,
                'image' => 'img/momo.png',
                'author' => 'Fahad Arifin',
                'role' => 'Graphic Designer',
                'rating' => 4.9,
            ],
            [
                'title' => 'Fullstack Web Dev',
                'category' => 'CODE',
                'price' => 89,
                'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085',
                'author' => 'Budi Santoso',
                'role' => 'Fullstack Engineer',
                'rating' => 5.0,
            ],
            [
                'title' => 'Data Science',
                'category' => 'DATA',
                'price' => 75,
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f',
                'author' => 'Siti Aminah',
                'role' => 'Data Scientist',
                'rating' => 4.8,
            ],
        ];
        return view('courses', compact('courses'));
    }
}
