<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Http\Requests\MajorRequest;
use Illuminate\Validation\ValidationException;
use App\Contracts\Services\MajorServiceInterface;

class MajorController extends Controller
{
    /**
     * major service
     */
    private $majorService;

    /**
     * Constructor function for  major controller
     *
     * @param MajorServiceInterface $majorServiceInterface
     */
    public function __construct(MajorServiceInterface $majorServiceInterface)
    {
        $this->majorService = $majorServiceInterface;
    }

    /**
     * Get majors
     *
     * @return View
     */
    public function index()
    {
        $majors = $this->majorService->getMajors();
        return view('major.index', compact('majors'));
    }

    /**
     * Redirect to create major page
     *
     * @return View
     */
    public function create()
    {
        return view('major.create');
    }

    /**
     * Create major
     *
     * @param MajorRequest $majorRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MajorRequest $majorRequest)
    {
        try {
            $this->majorService->storeMajor($majorRequest->toArray());
            return redirect()->route('majors.index');
        } catch (ValidationException $e) {
            return redirect()->route('majors.create')->withInput()->withErrors($e->validator);
        }
    }

    /**
     * Redirect to edit major page
     *
     * @param int $id
     * @return View
     */
    public function edit($id)
    {
        $major = $this->majorService->getMajorById($id);
        return view('major.edit', compact('major'));
    }

    /**
     * Update major
     *
     * @param MajorRequest $majorRequest
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MajorRequest $majorRequest, $id)
    {
        try {
            $data = $majorRequest->toArray();
            $this->majorService->updateMajor($data, $id);
            return redirect()->route('majors.index');
        } catch (ValidationException $e) {
            return redirect()->route('majors.edit', $id)->withInput()->withErrors($e->validator);
        }
    }

    /**
     * Delete major
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->majorService->deleteMajor($id);
        return redirect()->route('majors.index');
    }
}
