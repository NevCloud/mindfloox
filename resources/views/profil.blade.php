{{-- Halaman Profil (semua role) — unified component --}}
<x-profil-page :user="$user" :programs="$programs ?? collect()" />
