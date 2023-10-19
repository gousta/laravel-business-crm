<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\User\CreateRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();

        return view('user.index', [
            'users' => $users,
        ]);
    }

    public function create(Request $request)
    {
        $user = $request->old();

        if(empty($user['role'])) {
            $user['role'] = config('crm.role_default');
        }

        return view('user.create', [
            'user' => $user,
        ]);
    }

    public function store(CreateRequest $request)
    {
        $data = $request->all();
        $data['show_in_calendar'] = isset($data['show_in_calendar']);

        $user = User::create($data);

        if (empty($user->id)) {
            dump($user);
        }

        return redirect()->route('user.index')->with('status', $this->ok);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('user.show', [
            'user' => $user,
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('user.edit', [
            'user' => $user,
        ]);
    }

    public function update(CreateRequest $request, $id)
    {
        $data = $request->all();

        if(empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        $data['show_in_calendar'] = isset($data['show_in_calendar']);

        $user = User::findOrFail($id);
        $user->update($data);

        return redirect()->route('user.edit', $user->id)->with('status', $this->ok);
    }

    public function destroy($id)
    {
        //
    }
}
