<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS Navigation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-dark text-white">
                        <h1 class="h2 mb-0 text-center">Learning Management System</h1>
                    </div>
                    <div class="card-body text-center">
                        <p class="lead mb-4">Welcome to the LMS. Choose a section to manage:</p>
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="card h-100 border-primary">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">
                                            <i class="bi bi-people"></i> Students
                                        </h5>
                                        <p class="card-text">Manage student information including names and email addresses.</p>
                                        <a href="{{ route('students.index') }}" class="btn btn-primary">Manage Students</a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="card h-100 border-success">
                                    <div class="card-body">
                                        <h5 class="card-title text-success">
                                            <i class="bi bi-book"></i> Courses
                                        </h5>
                                        <p class="card-text">Manage course information including names and descriptions.</p>
                                        <a href="{{ route('courses.index') }}" class="btn btn-success">Manage Courses</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <h6 class="text-muted">System Information:</h6>
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <div class="p-3">
                                        <h4 class="text-primary">{{ App\Models\Student::count() }}</h4>
                                        <small class="text-muted">Students</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3">
                                        <h4 class="text-success">{{ App\Models\Course::count() }}</h4>
                                        <small class="text-muted">Courses</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3">
                                        <h4 class="text-info">{{ App\Models\Professor::count() }}</h4>
                                        <small class="text-muted">Professors</small>
                                    </div>
                                </div>
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