<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\TestService;
use App\Http\Requests\TestCreateRequest;
use App\Http\Requests\TestUpdateRequest;

class TestsController extends Controller
{
    public function __construct(TestService $test_service)
    {
        $this->service = $test_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tests = $this->service->paginated();
        return view('tests.index')->with('tests', $tests);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $tests = $this->service->search($request->search);
        return view('tests.index')->with('tests', $tests);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\TestCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestCreateRequest $request)
    {
        $result = $this->service->create($request->except('_token'));

        if ($result) {
            return redirect(route('tests.edit', ['id' => $result->id]))->with('message', 'Successfully created');
        }

        return redirect(route('tests.index'))->withErrors('Failed to create');
    }

    /**
     * Display the test.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test = $this->service->find($id);
        return view('tests.show')->with('test', $test);
    }

    /**
     * Show the form for editing the test.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $test = $this->service->find($id);
        return view('tests.edit')->with('test', $test);
    }

    /**
     * Update the tests in storage.
     *
     * @param  App\Http\Requests\TestUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TestUpdateRequest $request, $id)
    {
        $result = $this->service->update($id, $request->except('_token'));

        if ($result) {
            return back()->with('message', 'Successfully updated');
        }

        return back()->withErrors('Failed to update');
    }

    /**
     * Remove the tests from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->service->destroy($id);

        if ($result) {
            return redirect(route('tests.index'))->with('message', 'Successfully deleted');
        }

        return redirect(route('tests.index'))->withErrors('Failed to delete');
    }
}
