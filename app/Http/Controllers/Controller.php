<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Hash;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function indexUsers(Request $request)
    {
        $users = User::orderBy('role', 'asc')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new rooms.
     *
     * @return Response
     */
    public function createUsers()
    {
        return view('users.create');
    }

    /**
     * Store a newly created rooms in storage.
     *
     * @param CreateroomsRequest $request
     *
     * @return Response
     */
    public function storeUsers(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'],
            'role' => ['required', 'in:admin,manager'],
        ]);

        User::create([
            "name" => $request["name"],
            "email" => $request["email"],
            "password" =>  Hash::make($request["password"]),
            "role" =>  $request["role"],
        ]);

        Flash::success('User saved successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified rooms.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function showUsers($id)
    {
        $user = User::find($id);

        if (!$user) {
            Flash::error('Users not found');

            return redirect(route('users.index'));
        }

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified rooms.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function editUsers($id)
    {
        $user = User::find($id);

        if (!$user) {
            Flash::error('Users not found');

            return redirect(route('users.index'));
        }

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified rooms in storage.
     *
     * @param  int $id
     * @param UpdateroomsRequest $request
     *
     * @return Response
     */
    public function updateUsers($id, Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'role' => ['required', 'in:admin,manager'],
        ]);
        $user = User::find($id);

        if ($request["email"] != $user->email) {
            $this->validate($request, [
                'email' => ['unique:users'],
            ]);
        }

        if (isset($request["password"]) and $request["password"] != "") {
            $this->validate($request, [
                'password' => ['confirmed', 'min:6'],
            ]);
        }

        if (!$user) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }
        if (isset($request["password"]) and $request["password"] != "") {
            $user->update([
                "name" => $request["name"],
                "email" => $request["email"],
                "password" =>  Hash::make($request["password"]),
                "role" =>  $request["role"],
            ]);
        } else {
            $user->update([
                "name" => $request["name"],
                "email" => $request["email"],
                "role" =>  $request["role"],
            ]);
        }

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified rooms from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroyUsers($id)
    {
        $user = User::find($id);
        if (!$user) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $user->delete();


        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }

}
