<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h1 class="h3 mb-0 text-center">Students Management</h1>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">All Students</h5>
                            <a href="{{ route('students.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Add New Student
                            </a>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Enrolled Courses</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($students as $student)
                                        <tr>
                                            <td>{{ $student->id }}</td>
                                            <td>{{ $student->fname }}</td>
                                            <td>{{ $student->lname }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>
                                                @if($student->courses->count() > 0)
                                                    <div class="d-flex flex-wrap gap-1">
                                                        @foreach($student->courses->take(3) as $course)
                                                            <span class="badge bg-info">{{ $course->name }}</span>
                                                        @endforeach
                                                        @if($student->courses->count() > 3)
                                                            <span class="badge bg-secondary">+{{ $student->courses->count() - 3 }} more</span>
                                                        @endif
                                                    </div>
                                                @else
                                                    <span class="text-muted">No courses</span>
                                                @endif
                                            </td>
                                            <td>{{ $student->created_at->format('M d, Y H:i') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('students.show', $student) }}" class="btn btn-info btn-sm">
                                                        <i class="bi bi-eye"></i> View
                                                    </a>
                                                    <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </a>
                                                    <form action="{{ route('students.destroy', $student) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?')">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="bi bi-inbox display-4"></i>
                                                    <p class="mt-2">No students found.</p>
                                                    <a href="{{ route('students.create') }}" class="btn btn-primary">Add your first student</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="text-center mt-4">
                            <a href="{{ route('home') }}" class="btn btn-secondary">
                                <i class="bi bi-house"></i> Back to Home
                            </a>
                            <a href="{{ route('courses.index') }}" class="btn btn-success ms-2">
                                <i class="bi bi-book"></i> View Courses
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 