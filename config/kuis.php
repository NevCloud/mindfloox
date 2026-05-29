<?php

return [
    [
        'id' => 1,
        'title' => 'Analisis Algoritma Sorting',
        'deadline' => '15 Jan 2024',
        'questions' => [
            [
                'id' => 1,
                'type' => 'multiple_choice',
                'question' =>
                'Algoritma manakah yang memiliki kompleksitas waktu terbaik untuk sorting?',
                'options' => [
                    'A' => 'Bubble Sort',
                    'B' => 'Quick Sort',
                    'C' => 'Selection Sort',
                    'D' => 'Insertion Sort',
                ],
                'answer' => 'B',
            ],
            [
                'id' => 2,
                'type' => 'essay',
                'question' =>
                'Merge Sort memiliki kompleksitas O(n log n) dalam semua kasus karena...',
                'answer' =>
                'algoritma ini selalu membagi array menjadi dua bagian dan menggabungkannya kembali',
            ],
            [
                'id' => 3,
                'type' => 'multiple_choice',
                'question' =>
                'Berapa jumlah perbandingan minimum yang diperlukan Bubble Sort untuk array yang sudah terurut?',
                'options' => [
                    'A' => 'n²',
                    'B' => 'n',
                    'C' => 'n-1',
                    'D' => 'n log n',
                ],
                'answer' => 'C',
            ],
            [
                'id' => 4,
                'type' => 'essay',
                'question' => 'Keuntungan utama Quick Sort dibanding Merge Sort adalah...',
                'answer' =>
                'Quick Sort menggunakan space complexity O(log n) sedangkan Merge Sort membutuhkan O(n)',
            ],
        ],
    ],
];
