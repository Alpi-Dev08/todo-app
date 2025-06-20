<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();

        return view('tasks.index', [
            'open' => Task::where('user_id', $userId)->whereNull('status')->get(),
            'onProgress' => Task::where('user_id', $userId)->where('status', 'on_progress')->latest()->get(),
            'done' => Task::where('user_id', $userId)->where('status', 'done')->latest()->get(),
            'cancelled' => Task::where('user_id', $userId)->where('status', 'cancelled')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deadline' => 'nullable|date',
            'deskripsi' => 'nullable|string',
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'deadline' => $request->deadline,
            // 'status' => null, 
        ]);

        return redirect()->back()->with('success', 'Task berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'deadline' => 'nullable|date',
            'status' => 'nullable|in:on_progress',
        ]);

        $task = Task::where('user_id', auth()->id())->findOrFail($id);
        $task->update($request->only(['judul', 'deskripsi', 'deadline', 'status']));

        return redirect()->route('tasks.index')->with('success', 'Task berhasil diubah.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::where('user_id', auth()->id())->findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task berhasil dihapus.');
    }

    public function updateStatus($id, $status)
    {
        $task = Task::where('user_id', auth()->id())->findOrFail($id);

        // Validasi status
        if (!in_array($status, ['on_progress', 'done', 'cancelled'])) {
            abort(400, 'status gagal');
        }

        $task->status = $status;
        $task->save();

        return redirect()->route('tasks.index')->with('success', "Tugas di tandai sebagai {$status}.");
    }


}
