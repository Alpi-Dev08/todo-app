<x-app-layout>
<style>
     #pills-all-tab:hover {
        background-color:#2d5dd6 !important;
        color: white !important;
    }

    #pills-progress-tab:hover {
        background-color:#ffcc80 !important;
        color: white !important;
    }

    #pills-done-tab:hover {
        background-color:#42d68f !important;
        color: white !important;
    }

    #pills-cancelled-tab:hover {
        background-color:#ff6681 !important;
        color: white !important;
    }

    #pills-all-tab.active {
        background-color:#2d5dd6 !important;
        color: white !important;
    }

    #pills-progress-tab.active {
        background-color:#ffcc80 !important;
        color: white !important;
    }

    #pills-done-tab.active {
        background-color:#42d68f !important;
        color: white !important;
    }

    #pills-cancelled-tab.active {
        background-color:#ff6681 !important;
        color: white !important;
    }
    
    .accordion-header-primary .accordion-button {
        background-color:#2d5dd6 !important;
        color: white !important;
    }

    .accordion-header-warning .accordion-button {
        background-color:#ffcc80 !important;
        color: white !important;
    }

    .accordion-header-success .accordion-button {
        background-color:#42d68f !important;
        color: white !important;
    }

    .accordion-header-danger .accordion-button {
        background-color:#ff6681 !important;
        color: white !important;
    }

</style>
<div class="container mt-3 mb-3">
    <div class="card p-4" style="border: none;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>List Tasks</h4>
        </div>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
 
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="judul">Tasking</label>
                <input type="text" name="judul" id="judul" class="form-control mt-2" placeholder="Enter task name">
            </div>
            <div class="mb-3">
                <label for="deadline">Due Date</label>
                <input type="date" name="deadline" id="deadline" class="form-control mt-2">
            </div>
            <div class="mb-3">
                <label for="deskripsi">Description</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control mt-2"></textarea>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Add Tasking</button>
            </div>
        </form>

        <ul class="nav nav-pills mb-3 mt-4" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="true">
                Open
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-progress-tab" data-bs-toggle="pill" data-bs-target="#pills-progress" type="button" role="tab" aria-controls="pills-progress" aria-selected="false">
                On Progress
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-done-tab" data-bs-toggle="pill" data-bs-target="#pills-done" type="button" role="tab" aria-controls="pills-done" aria-selected="false">
                Done
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-cancelled-tab" data-bs-toggle="pill" data-bs-target="#pills-cancelled" type="button" role="tab" aria-controls="pills-cancelled" aria-selected="false">
                Cancelled
                </button>
            </li> 
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab" tabindex="0">
                <div class="accordion mt-3" id="accordionAll">
                    <div class="accordion-item">
                        <h2 class="accordion-header accordion-header-primary">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAll" aria-expanded="true" aria-controls="collapseAll">
                                <strong>Open</strong> <span style="margin-left: 1%;">{{ $open->count() }} Tasks</span>
                            </button>
                        </h2> 
                        <div id="collapseAll" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                @forelse ($open as $task)
                                    <div class="card mb-3 shadow-sm border-0 position-relative">
                                        <div class="card-body">
                                            <div class="dropdown position-absolute top-0 end-0 mt-2 me-3">
                                                <a href="#" class="text-muted" data-bs-toggle="dropdown">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"><circle cx="5" cy="12" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/></svg>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editModal{{ $task->id }}">
                                                            <i class="bi bi-pencil me-2"></i>Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                         <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?')" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-danger">
                                                                <i class="bi bi-trash me-2"></i>Delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>

                                            <!-- Modal Edit Task -->
                                            <div class="modal fade" id="editModal{{ $task->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $task->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $task->id }}">Edit Task</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label for="judul{{ $task->id }}" class="form-label">Judul</label>
                                                        <input type="text" name="judul" class="form-control" id="judul{{ $task->id }}" value="{{ $task->judul }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="deadline{{ $task->id }}" class="form-label">Due Date</label>
                                                        <input type="date" name="deadline" class="form-control" id="deadline{{ $task->id }}" value="{{ $task->deadline }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="deskripsi{{ $task->id }}" class="form-label">Deskripsi</label>
                                                        <textarea name="deskripsi" class="form-control" id="deskripsi{{ $task->id }}" rows="3">{{ $task->deskripsi }}</textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="status{{ $task->id }}" class="form-label">Status</label>
                                                        <select name="status" class="form-select" id="status{{ $task->id }}">
                                                        <option value="on_progress" {{ $task->status === 'on_progress' ? 'selected' : '' }}>On Progress</option>
                                                        </select>
                                                    </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update Task</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                            </div>

                                            <h5 class="card-title mb-1">{{ $task->judul }}</h5>
                                            <small class="text-muted d-block mb-2">Due Date: {{ \Carbon\Carbon::parse($task->deadline)->format('l, d M Y') }}</small>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted">No tasks found.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade" id="pills-progress" role="tabpanel" aria-labelledby="pills-progress-tab" tabindex="0">
                <div class="accordion mt-3" id="accordiononprogress">
                    <div class="accordion-item">
                        <h2 class="accordion-header accordion-header-warning">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayonprogress" aria-expanded="true" aria-controls="panelsStayonprogress">
                                <strong>On Progress</strong> <span style="margin-left: 1%;">{{ $onProgress->count() }} Tasks</span>
                            </button>
                        </h2>
                        <div id="panelsStayonprogress" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                @forelse ($onProgress as $task)
                                    <div class="card mb-3 shadow-sm border-0 position-relative">
                                        <div class="card-body">
                                            <div class="dropdown position-absolute top-0 end-0 mt-2 me-3">
                                                <a href="#" class="text-muted" data-bs-toggle="dropdown">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"><circle cx="5" cy="12" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/></svg>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <form action="{{ route('tasks.updateStatus', ['task' => $task->id, 'status' => 'done']) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="dropdown-item">
                                                                <i class="bi bi-check-circle me-2"></i>Done
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('tasks.updateStatus', ['task' => $task->id, 'status' => 'cancelled']) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="dropdown-item text-danger">
                                                                <i class="bi bi-x-circle me-2"></i>Cancelled
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>

                                            <h5 class="card-title mb-1">{{ $task->judul }}</h5>
                                            <small class="text-muted d-block mb-2">Due Date: {{ \Carbon\Carbon::parse($task->deadline)->format('l, d M Y') }}</small>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted">No tasks found.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade" id="pills-done" role="tabpanel" aria-labelledby="pills-done-tab" tabindex="0">
                 <div class="accordion mt-3" id="accordiondone">
                    <div class="accordion-item">
                        <h2 class="accordion-header accordion-header-success">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsstaydone" aria-expanded="true" aria-controls="panelsstaydone">
                            <strong>Done</strong> <span style="margin-left: 1%;">{{ $done->count() }} Tasks</span>
                        </button> 
                        </h2>
                        <div id="panelsstaydone" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            @forelse ($done as $task)
                                    <div class="card mb-3 shadow-sm border-0 position-relative">
                                        <div class="card-body">
                                            <h5 class="card-title mb-1">{{ $task->judul }}</h5>
                                            <small class="text-muted d-block mb-2">Due Date: {{ \Carbon\Carbon::parse($task->deadline)->format('l, d M Y') }}</small>
                                        </div>
                                    </div>
                            @empty
                                    <p class="text-muted">No tasks found.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade" id="pills-cancelled" role="tabpanel" aria-labelledby="pills-cancelled-tab" tabindex="0">
                <div class="accordion mt-3" id="accordioncencelled">
                    <div class="accordion-item">
                        <h2 class="accordion-header accordion-header-danger">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStaycancelled" aria-expanded="true" aria-controls="panelsStaycancelled">
                            <strong>Cancelled</strong> <span style="margin-left: 1%;">{{ $cancelled->count() }} Tasks</span>
                        </button>
                        </h2>
                        <div id="panelsStaycancelled" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                @forelse ($cancelled as $task)
                                    <div class="card mb-3 shadow-sm border-0 position-relative">
                                        <div class="card-body">
                                            <h5 class="card-title mb-1">{{ $task->judul }}</h5>
                                            <small class="text-muted d-block mb-2">Due Date: {{ \Carbon\Carbon::parse($task->deadline)->format('l, d M Y') }}</small>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted">No tasks found.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
</x-app-layout>
