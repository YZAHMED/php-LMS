<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Exception;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Get all students ordered by latest first with their courses
            $students = Student::with('courses')->latest()->get();
            
            // Return the students index view with data
            return view('students.index', compact('students'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load students. Please try again.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            // Get all available courses for selection
            $courses = Course::all();
            
            // Return the create student form view with courses
            return view('students.create', compact('courses'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load create form. Please try again.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        try {
            // Create a new student with validated data
            $student = Student::create($request->validated());
            
            // Attach selected courses if any
            if ($request->has('course_ids')) {
                $student->courses()->attach($request->course_ids);
            }
            
            // Redirect to students index with success message
            return redirect()->route('students.index')
                ->with('success', 'Student created successfully!');
        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create student. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        try {
            // Load the student with their courses
            $student->load('courses');
            
            // Return the show student view with student data
            return view('students.show', compact('student'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load student details. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        try {
            // Load the student with their courses
            $student->load('courses');
            
            // Get all available courses for selection
            $courses = Course::all();
            
            // Return the edit student form view with student data and courses
            return view('students.edit', compact('student', 'courses'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load edit form. Please try again.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        try {
            // Update the student with validated data
            $student->update($request->validated());
            
            // Sync selected courses
            if ($request->has('course_ids')) {
                $student->courses()->sync($request->course_ids);
            } else {
                $student->courses()->detach();
            }
            
            // Redirect to students index with success message
            return redirect()->route('students.index')
                ->with('success', 'Student updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update student. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try {
            // Detach all courses first
            $student->courses()->detach();
            
            // Delete the student
            $student->delete();
            
            // Redirect to students index with success message
            return redirect()->route('students.index')
                ->with('success', 'Student deleted successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete student. Please try again.');
        }
    }
}
