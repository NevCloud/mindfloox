<div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700 mt-6">
    <a href="{{ route('instruktur.kursus.show', $kursus->id) }}"
        class="inline-flex items-center gap-1.5 px-6 py-2.5 rounded-xl text-sm font-medium border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        Batal
    </a>
    <button type="submit"
        class="px-6 py-2.5 rounded-xl text-sm font-medium bg-primary text-white hover:opacity-90 transition flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
        <span x-text="tipeMateri === 'kuis' ? 'Simpan Kuis' : (tipeMateri === 'tugas' ? 'Simpan Tugas' : 'Upload Materi')"></span>
    </button>
</div>
