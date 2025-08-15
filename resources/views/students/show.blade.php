<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h1 class="h3 mb-0 text-center">Student Details</h1>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Student ID:</label>
                                    <p class="form-control-plaintext">{{ $student->id }}</p>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label fw-bold">First Name:</label>
                                    <p class="form-control-plaintext">{{ $student->fname }}</p>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Last Name:</label>
                                    <p class="form-control-plaintext">{{ $student->lname }}</p>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Email:</label>
                                    <p class="form-control-plaintext">{{ $student->email }}</p>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Enrolled Courses:</label>
                                    @if($student->courses->count() > 0)
                                        <div class="row">
                                            @foreach($student->courses as $course)
                                                <div class="col-md-6 mb-2">
                                                    <div class="card border-info">
                                                        <div class="card-body p-2">
                                                            <h6 class="card-title mb-1">{{ $course->name }}</h6>
                                                            <p class="card-text small mb-1">{{ Str::limit($course->description, 80) }}</p>
                                                            @if($course->professor)
                                                                <small class="text-muted">Prof. {{ $course->professor->name }}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted">No courses enrolled.</p>
                                    @endif
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Created At:</label>
                                    <p class="form-control-plaintext">{{ $student->created_at->format('F d, Y \a\t g:i A') }}</p>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Last Updated:</label>
                                    <p class="form-control-plaintext">{{ $student->updated_at->format('F d, Y \a\t g:i A') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center mt-4">
                            <div class="btn-group" role="group">
                                <a href="{{ route('students.edit', $student) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil"></i> Edit Student
                                </a>
                                <a href="{{ route('students.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back to List
                                </a>
                                <form action="{{ route('students.destroy', $student) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this student?')">
                                        <i class="bi bi-trash"></i> Delete Student
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
