@extends('layouts.app')

@section('content')
<section class="min-vh-100" style="background: linear-gradient(to bottom right, #0d47a1, #1976d2); min-height: 100dvh;">
    <div class="container py-5">
        <div class="text-center mb-4">
            <h1 class="text-white fw-bold mb-3">
                <i class="fas fa-check-circle fa-2x bg-white text-primary rounded-circle p-2 shadow-sm"></i><br>
                My Todo-s
            </h1>
        </div>

        <!-- ✅ Tambah Tugas -->
        <div id="form-task" class="card mb-5 border-0 shadow-sm" style="background-color: #eef4ff;">
            <div class="card-body">
                <h5 class="mb-3 text-primary fw-bold">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Tugas
                </h5>
                <form action="{{ route('store') }}" method="POST" class="row gy-2 gx-3 align-items-center">
                    @csrf
                    <div class="col-sm-12 col-md-3">
                        <input type="text" name="name" class="form-control shadow-sm" placeholder="Nama tugas" required>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <input type="text" name="description" class="form-control shadow-sm" placeholder="Deskripsi" required>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <input type="date" name="deadline" class="form-control shadow-sm" required>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <select name="status" class="form-select shadow-sm" required>
                            <option value="Todo">Todo</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Done">Done</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-grid">
                        <button type="submit" class="btn btn-primary shadow-sm">
                            <i class="fas fa-paper-plane me-1"></i> Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @php
            $statuses = ['Todo', 'In Progress', 'Done'];
        @endphp

        <div class="row justify-content-center g-4" id="kanban-board">
            @foreach ($statuses as $status)
                <div class="col-12 col-md-4">
                    <div class="card shadow border-0" style="background-color: #0d47a1; border-radius: 20px;">
                        <div class="card-header text-white text-center fw-bold bg-transparent border-0">
                            {{ $status }}
                        </div>
                        <div class="card-body todo-column px-3 py-2" data-status="{{ $status }}">
                            <ul class="list-group bg-light rounded shadow-sm">
                                @forelse ($todos->where('status', $status) as $todo)
                                    <li class="list-group-item mb-2 shadow-sm border rounded" data-id="{{ $todo->id }}">
                                        <strong>{{ $todo->name }}</strong><br>
                                        <small class="text-muted">{{ $todo->description }}</small><br>
                                        @if (!empty($todo->deadline))
                                            <small class="text-muted">
                                                🗓 {{ \Carbon\Carbon::parse($todo->deadline)->format('d M Y') }}
                                            </small><br>
                                        @endif
                                        <div class="mt-2 d-flex justify-content-end">
                                            <a href="{{ route('edit', ['todo' => $todo->id]) }}" class="text-info me-3">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="{{ route('delete', ['todo' => $todo->id]) }}" class="text-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </li>
                                @empty
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
        <script>
            document.querySelectorAll('.todo-column').forEach(column => {
                new Sortable(column.querySelector('ul'), {
                    group: 'kanban',
                    animation: 150,
                    onAdd: function (evt) {
                        const todoId = evt.item.getAttribute('data-id');
                        const newStatus = column.getAttribute('data-status');
                        fetch('/update-status', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ id: todoId, status: newStatus })
                        });
                    }
                });
            });
        </script>

        <style>
            .todo-column {
                max-height: 420px;
                overflow-y: auto;
                background-color: #f9f9f9;
                border-radius: 12px;
            }

            .list-group-item {
                background-color: #ffffff;
                border-left: 5px solid #1976d2;
                padding: 12px;
            }

            .list-group-item:hover {
                background-color: #e3f2fd;
            }
        </style>
    </div>
</section>
@endsection