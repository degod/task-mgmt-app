<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks Manager</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Tasks Manager</h1>
        
        <!-- Flash Messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Filter by Project -->
        <form method="GET" action="{{ route('home') }}" class="mb-4">
            <div class="form-row">
                <div class="col">
                    <select name="project_id" class="form-control" onchange="this.form.submit()">
                        <option value="">Select Project</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#createTaskModal">Create Task</button>
                    <button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#createProjectModal">Create Project</button>
                </div>
            </div>
        </form>

        <!-- Tasks Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Project</th>
                    <th>Task Name</th>
                    <th>Priority</th>
                    <th>Creation Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="taskTableBody">
                @forelse ($tasks as $task)
                    <tr data-id="{{ $task->id }}" data-priority="{{ $task->priority }}">
                        <td>{{ $task->project->name }}</td>
                        <td>{{ $task->task_name }}</td>
                        <td>{{ $task->priority }}</td>
                        <td>{{ $task->created_at->format('d M Y') }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editTaskModal" data-id="{{ $task->id }}" data-task_name="{{ $task->task_name }}" data-priority="{{ $task->priority }}" data-project_id="{{ $task->project_id }}">
                                Edit
                            </button>

                            <!-- Delete Button -->
                            <form method="POST" action="{{ route('tasks.delete', $task->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No tasks found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Edit Task Modal -->
    <div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="editTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editTaskForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="task_name">Task Name</label>
                            <input type="text" class="form-control" id="task_name" name="task_name" required>
                        </div>
                        <div class="form-group">
                            <label for="priority">Priority</label>
                            <input type="number" class="form-control" id="priority" name="priority" min="1" max="10" required>
                        </div>
                        <div class="form-group">
                            <label for="project_id">Project</label>
                            <select class="form-control" id="project_id" name="project_id" required>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Create Task Modal -->
    <div class="modal fade" id="createTaskModal" tabindex="-1" role="dialog" aria-labelledby="createTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTaskModalLabel">Create Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="task_name">Task Name</label>
                            <input type="text" class="form-control" id="task_name" name="task_name" required>
                        </div>
                        <div class="form-group">
                            <label for="priority">Priority</label>
                            <input type="number" class="form-control" id="priority" name="priority" min="1" max="10" required>
                        </div>
                        <div class="form-group">
                            <label for="project_id">Project</label>
                            <select class="form-control" id="project_id" name="project_id" required>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Create Project Modal -->
    <div class="modal fade" id="createProjectModal" tabindex="-1" role="dialog" aria-labelledby="createProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createProjectModalLabel">Create Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('projects.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Project Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <script>
        // Populate edit task modal with data
        $('#editTaskModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var taskId = button.data('id');
            var taskName = button.data('task_name');
            var priority = button.data('priority');
            var projectId = button.data('project_id');

            var modal = $(this);
            modal.find('#task_name').val(taskName);
            modal.find('#priority').val(priority);
            modal.find('#project_id').val(projectId);

            var form = modal.find('form');
            form.attr('action', '/tasks/' + taskId);
        });

        // Initialize SortableJS on the task table body
        var sortable = Sortable.create(document.getElementById('taskTableBody'), {
            animation: 150,
            onEnd: function (evt) {
                // Get reordered tasks
                var reorderedTasks = [];
                document.querySelectorAll('#taskTableBody tr').forEach((row, index) => {
                    var taskId = row.getAttribute('data-id');
                    reorderedTasks.push({ id: taskId, priority: index + 1 });
                });

                // Send the reordered tasks to the server
                fetch('{{ route('tasks.reorder') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ tasks: reorderedTasks })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Tasks reordered successfully.');
                    } else {
                        alert('Failed to reorder tasks.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    </script>
</body>
</html>
