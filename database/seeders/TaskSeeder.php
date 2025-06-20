<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use Illuminate\Support\Carbon;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        Task::create([
            'user_id' => 2,
            'judul' => 'Membuat UI/UX',
            'deskripsi' => 'membuat UI/UX untuk aplikasi todo App',
            'deadline' => Carbon::parse('2025-06-20'),
            'status' => 'cancelled',
        ]);

        Task::create([
            'user_id' => 2,
            'judul' => 'Setup Project',
            'deskripsi' => 'setup project untuk aplikasi todo App',
            'deadline' => Carbon::parse('2025-07-01'),
            'status' => 'done',
        ]);

	    Task::create([
            'user_id' => 2,
            'judul' => 'Develop Project',
            'deskripsi' => 'development aplikasi todo App',
            'deadline' => Carbon::parse('2025-07-03'),
            'status' => 'on_progress',
        ]);

        Task::create([
            'user_id' => 3,
            'judul' => 'Research Konten',
            'deskripsi' => 'research untuk konten sosial media kliniksatriabudi',
            'deadline' => Carbon::parse('2025-07-03'),
            'status' => 'on_progress',
        ]);

        Task::create([
            'user_id' => 3,
            'judul' => 'Membuat Konten',
            'deskripsi' => 'membuat Konten untuk konten sosial media kliniksatriabudi',
            'deadline' => Carbon::parse('2025-06-20'),
            'status' => 'on_progress',
        ]);
    }
}
 