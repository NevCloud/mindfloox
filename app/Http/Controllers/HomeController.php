<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
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
                'students' => 79,
            ],
            [
                'title' => 'Fullstack Web Dev',
                'category' => 'CODE',
                'price' => 89,
                'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085',
                'author' => 'Budi Santoso',
                'role' => 'Fullstack Engineer',
                'rating' => 5.0,
                'students' => 159,
            ],
            [
                'title' => 'Data Science',
                'category' => 'DATA',
                'price' => 75,
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f',
                'author' => 'Siti Aminah',
                'role' => 'Data Scientist',
                'rating' => 4.8,
                'students' => 49,
            ],
        ];

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

        $categories = [
            [
                'name' => 'Development',
                'count' => '1.2k+',
                'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4',
                'color' => 'text-blue-400',
            ],
            [
                'name' => 'Design',
                'count' => '850+',
                'icon' => 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01',
                'color' => 'text-purple-400',
            ],
            [
                'name' => 'Marketing',
                'count' => '430+',
                'icon' => 'M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z',
                'color' => 'text-orange-400',
            ],
            [
                'name' => 'Data Science',
                'count' => '200+',
                'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                'color' => 'text-green-400',
            ],
            [
                'name' => 'Cyber Security',
                'count' => '150+',
                'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                'color' => 'text-red-400',
            ],
            [
                'name' => 'Mobile Dev',
                'count' => '320+',
                'icon' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z',
                'color' => 'text-indigo-400',
            ],
            [
                'name' => 'Photography',
                'count' => '180+',
                'icon' => 'M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z M15 13a3 3 0 11-6 0 3 3 0 016 0z',
                'color' => 'text-yellow-400',
            ],
            [
                'name' => 'Finance',
                'count' => '95+',
                'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                'color' => 'text-emerald-400',
            ],
            [
                'name' => 'Blockchain',
                'count' => '70+',
                'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
                'color' => 'text-cyan-400',
            ],
            [
                'name' => 'Cloud Computing',
                'count' => '110+',
                'icon' => 'M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z',
                'color' => 'text-sky-400',
            ],
            [
                'name' => 'Artificial Intelligence',
                'count' => '240+',
                'icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z',
                'color' => 'text-rose-400',
            ],
            [
                'name' => 'Game Development',
                'count' => '140+',
                'icon' => 'M11 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2v-7M16 4v12M12 4v12m-8-8h16M8 4v12',
                'color' => 'text-pink-400',
            ],
            [
                'name' => 'Business Strategy',
                'count' => '190+',
                'icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6',
                'color' => 'text-lime-400',
            ],
            [
                'name' => 'Music Production',
                'count' => '65+',
                'icon' => 'M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3',
                'color' => 'text-violet-400',
            ],
            [
                'name' => 'Health & Fitness',
                'count' => '130+',
                'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                'color' => 'text-red-500',
            ],
            [
                'name' => 'Architecture',
                'count' => '55+',
                'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                'color' => 'text-amber-600',
            ],
            [
                'name' => 'Content Writing',
                'count' => '210+',
                'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
                'color' => 'text-teal-400',
            ],
            [
                'name' => 'Language Learning',
                'count' => '300+',
                'icon' => 'M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 11.37 9.188 16.503 5 20',
                'color' => 'text-fuchsia-400',
            ],
        ];
        return view('index', compact('courses', 'instructors', 'categories'));
    }
}
