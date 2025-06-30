@extends('layouts.app')

@section('content')

<form action="{{ route('update', ['todo' => $todo->id]) }}" method="post" class="mt-4 p-4">
    @csrf
    @method('PUT')

    <div class="form-group m-3">
        <label for="name">Todo Name</label>
        <input type="text" class="form-control" value="{{ $todo->name }}" name="name">
    </div>

    <div class="form-group m-3">
        <label for="description">Todo Description</label>
        <textarea class="form-control" name="description" rows="3">{{ $todo->description }}</textarea>
    </div>

    <div class="form-group m-3">
        <input type="submit" class="btn btn-primary float-end" value="Submit">
    </div>

    <div class="form-group m-3">
    <label for="deadline">Deadline</label>
    <input type="date" class="form-control" name="deadline" id="deadline" value="{{ old('deadline', $todo->deadline ? \Carbon\Carbon::parse($todo->deadline)->format('Y-m-d') : '') }}">
</div>

    <label for="location">📍 Lokasi (opsional)</label>
    <input type="text" name="location_name" id="location_name" class="form-control" placeholder="Misal: Kampus A, Rumah, Kantor">
    <input type="hidden" name="latitude" id="latitude">
    <input type="hidden" name="longitude" id="longitude">
    <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="getLocation()">Gunakan Lokasi Sekarang</button>
</div>

    <div class="form-group m-3">
    <label for="status">Status</label>
    <select class="form-control" name="status" id="status" required>
        <option value="Todo">Todo</option>
        <option value="In Progress">In Progress</option>
        <option value="Done">Done</option>
    </select>
</div>
</form>

@endsection
