<?php

namespace App\Http\Controllers;

use App\Http\Requests\MajorRequest;
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
     * @param \App\Contracts\Services\MajorServiceInterface $majorServiceInterface
     */
    public function __construct(MajorServiceInterface $majorServiceInterface)
    {
        $this->majorService = $majorServiceInterface;
    }

    /**
     * Get majors
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $majors = $this->majorService->getMajors();

        return view('major.index', compact('majors'));
    }

    /**
     * Redirect to create major page
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('major.create');
    }

    /**
     * Create major
     *
     * @param \App\Http\Requests\MajorRequest $majorRequest
     * @return void
     */
    public function store(MajorRequest $majorRequest)
    {
        $this->majorService->storeMajor($majorRequest->toArray());
    }

    /**
     * Redirect to edit major page
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $major = $this->majorService->getMajorById($id);

        return view('major.edit', compact('major'));
    }

    /**
     * Update major
     *
     * @param \App\Http\Requests\MajorRequest $majorRequest
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MajorRequest $majorRequest, $id)
    {
        $data = $majorRequest->toArray();
        $this->majorService->updateMajor($data, $id);

        return redirect()->route('majors.index');
    }

    /**
     * Delete major
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        $this->majorService->deleteMajor($id);
    }
}
