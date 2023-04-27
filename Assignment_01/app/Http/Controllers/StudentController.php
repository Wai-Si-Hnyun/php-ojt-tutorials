<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Contracts\Services\MajorServiceInterface;
use App\Contracts\Services\StudentServiceInterface;

class StudentController extends Controller
{
    /**
     * student service
     */
    private $studentService;
    /**
     * major service
     */
    private $majorService;

    /**
     * constructor function for student controller
     *
     * @param \App\Contracts\Services\StudentServiceInterface $studentServiceInterface
     * @param \App\Contracts\Services\MajorServiceInterface $majorServiceInterface
     */
    public function __construct(
        StudentServiceInterface $studentServiceInterface,
        MajorServiceInterface $majorServiceInterface
    ) {
        $this->studentService = $studentServiceInterface;
        $this->majorService = $majorServiceInterface;
    }

    /**
     * Get all students data and show
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $students = $this->studentService->getStudents();

        return view('students.index', compact('students'));
    }

    /**
     * Redirect to create page
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $majors = $this->majorService->getMajors();

        return view('students.create', compact('majors'));
    }

    /**
     * Create new student
     *
     * @param \App\Http\Requests\StudentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StudentRequest $request)
    {
        $this->studentService->storeStudent($request->toArray());

        return redirect()->route('students.index');
    }

    /**
     * redirect to edit page
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $majors = $this->majorService->getMajors();
        $student = $this->studentService->getStudentById($id);

        return view('students.edit', compact('student', 'majors'));
    }

    /**
     * Update student
     *
     * @param \App\Http\Requests\StudentRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StudentRequest $request, $id)
    {
        $this->studentService->updateStudent($request->toArray(), $id);

        return redirect()->route('students.index');
    }

    /**
     * Delete student
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->studentService->deleteStudent($id);

        return redirect()->route('students.index');
    }
}
