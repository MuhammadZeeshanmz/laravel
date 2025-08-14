<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5 bg-light">

    <div class="container">
        <h2 class="mb-4">Task Manager</h2>

        {{-- Insert Task Form --}}
        <form method="POST" action="{{ route('tasks.store') }}" class="card card-body mb-4">
            @csrf
            <h4>Add New Task</h4>
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Assigned At</label>
                <input type="datetime-local" name="assigned_at" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Created By</label>
                <input type="text" name="created_by" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Add Task</button>
        </form>

        {{-- Show All Tasks --}}
        <div class="card card-body">
            <h4>All Tasks</h4>
            @foreach($tasks as $task)
                <div class="border p-3 mb-3">
                    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row g-2">
                            <div class="col-md-3">
                                <input type="text" name="title" value="{{ $task->title }}" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="description" value="{{ $task->description }}" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <input type="datetime-local" name="assigned_at" value="{{ $task->assigned_at ? \Carbon\Carbon::parse($task->assigned_at)->format('Y-m-d\TH:i') : '' }}" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="created_by" value="{{ $task->created_by }}" class="form-control" required>
                            </div>
                            <div class="col-md-1 d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </form>
                   
                            </div>
                             <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
