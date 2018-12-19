<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\TesztService;
use App\Http\Requests\TesztCreateRequest;
use App\Http\Requests\TesztUpdateRequest;

class TesztsController extends Controller
{
    public function __construct(TesztService $teszt_service)
    {
        $this->service = $teszt_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $teszts = $this->service->paginated();
        return view('teszts.index')->with('teszts', $teszts);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $teszts = $this->service->search($request->search);
        return view('teszts.index')->with('teszts', $teszts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teszts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\TesztCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TesztCreateRequest $request)
    {
        $result = $this->service->create($request->except('_token'));

        if ($result) {
            return redirect(route('teszts.edit', ['id' => $result->id]))->with('message', 'Successfully created');
        }

        return redirect(route('teszts.index'))->withErrors('Failed to create');
    }

    /**
     * Display the teszt.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teszt = $this->service->find($id);
        return view('teszts.show')->with('teszt', $teszt);
    }

    /**
     * Show the form for editing the teszt.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teszt = $this->service->find($id);
        return view('teszts.edit')->with('teszt', $teszt);
    }

    /**
     * Update the teszts in storage.
     *
     * @param  App\Http\Requests\TesztUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TesztUpdateRequest $request, $id)
    {
        $result = $this->service->update($id, $request->except('_token'));

        if ($result) {
            return back()->with('message', 'Successfully updated');
        }

        return back()->withErrors('Failed to update');
    }

    /**
     * Remove the teszts from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->service->destroy($id);

        if ($result) {
            return redirect(route('teszts.index'))->with('message', 'Successfully deleted');
        }

        return redirect(route('teszts.index'))->withErrors('Failed to delete');
    }
}
