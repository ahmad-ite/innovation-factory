<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserServiceInterface;
use Illuminate\View\View;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserServiceInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $users = $this->user->list();

        return view('users.index', compact('users'))
           ->with('i', (request()->input('page', 1) - 1) * config('default.pagination.size'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->user->store($request->all());

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $user = $this->user->find($id);

        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);

        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $this->user->update($id, $request->all());

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->user->destroy($id);

        return redirect()->route('users.index');
    }

    /**
     * Display a trashed listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed(): View
    {
        $users = $this->user->listTrashed();

        return view('trashed_users.index', compact('users'))
           ->with('i', (request()->input('page', 1) - 1) * config('default.pagination.size'));
    }

    public function restore($id)
    {
        $this->user->restore($id);

        return redirect()->route('users.index');
    }

    public function delete($id)
    {
        $this->user->delete($id);

        return redirect()->route('users.trashed');
    }
}