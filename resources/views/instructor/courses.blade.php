@extends('layouts.instructor')
@section('title', 'Courses')
@section('content')

<x-banner />

<section>
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-base font-semibold dark:text-white">Course Saya</h3>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">

        @include('instructor.partials.course-card', [
            'href' => 'course',
            'bg' => 'rgba(33,150,243,0.15)',
            'img' => '../img/momo.png',
            'title' => 'UI/UX Design Specialist',
            'color' => '#2196f3',
            'percent' => '80%',
            'width' => '80%',
            'instructor' => 'Sarah Wijaya',
            'modul' => '8/10 Modul selesai',
            'status' => 'Hampir selesai',
            'btnClass' => 'bg-blue-500 hover:bg-blue-600',
        ])

        @include('instructor.partials.course-card', [
            'href' => 'course',
            'bg' => 'rgba(156,39,176,0.15)',
            'img' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085',
            'title' => 'Data Science Bootcamp',
            'color' => '#9c27b0',
            'percent' => '50%',
            'width' => '50%',
            'instructor' => 'Budi Santoso',
            'modul' => '6/12 Modul selesai',
            'status' => 'Berjalan',
            'btnClass' => 'bg-purple-500 hover:bg-purple-600',
        ])

        @include('instructor.partials.course-card', [
            'href' => 'course',
            'bg' => 'rgba(255,152,0,0.15)',
            'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f',
            'title' => 'Full-stack Laravel',
            'color' => '#ff9800',
            'percent' => '15%',
            'width' => '15%',
            'instructor' => 'Andi Hermawan',
            'modul' => '1/8 Modul selesai',
            'status' => 'Baru mulai',
            'btnClass' => 'bg-orange-500 hover:bg-orange-600',
        ])

        @include('instructor.partials.course-card', [
            'href' => 'course',
            'bg' => 'rgba(244,67,54,0.15)',
            'img' => 'https://plus.unsplash.com/premium_photo-1661877737564-3dfd7282efcb?q=80&w=2100&auto=format&fit=crop',
            'title' => 'Cyber Security Basic',
            'color' => '#f44336',
            'percent' => '100%',
            'width' => '100%',
            'instructor' => 'Rina Amelia',
            'modul' => '5/5 Modul selesai',
            'status' => 'Selesai',
            'btnClass' => 'bg-red-500 hover:bg-red-600',
        ])

    </div>
</section>

@endsection
