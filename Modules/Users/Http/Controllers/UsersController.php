<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Modules\Core\Entities\User;
use Modules\Core\Http\Controllers\Controller;
use Modules\Users\Http\Requests\UserRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $breadcrumbs = ['User'];
        $userModel = new User();
        $users = $userModel->where('id', '!=', Auth::user()->id);
        if ($request->search && $request->search != '') {
            $users = $users->where(function ($q) use ($request) {
                $q->orWhere('name', 'like', '%'.trim($request->search).'%');
                $q->orWhere('email', 'like', '%'.trim($request->search).'%');
            });
        }
        $users = $users->sortable(['updated_at' => 'desc'])
            ->paginate(20)
            ->withQueryString();
        return view('users::index', [
            'breadcrumbs' => $breadcrumbs,
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $breadcrumbs = [
            [
                'url' => route('user.index'),
                'name' => 'User'
            ],
            'Create',
        ];
        $title = "Create user";
        return view('users::create', [
            'breadcrumbs' => $breadcrumbs,
            'title' => $title,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make('12345678');
        $user->save();
        Session::flash('message-success', 'Successfully created user!');
        return redirect()->route('user.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $title = 'Edit user';
        $breadcrumbs = [
            [
                'url' => route('user.index'),
                'name' => 'User'
            ],
            'Edit',
        ];
        $user = User::findOrFail($id);
        if ($id != Auth::user()->id) {
            return view('users::edit', [
                'user' => $user,
                'breadcrumbs' => $breadcrumbs,
                'title' => $title,
            ]);
        }
        return redirect()->route('user.index');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        if ($id != Auth::user()->id) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->update();
            Session::flash('message-success', 'Successfully updated user!');
        }
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Session::flash('message-success', 'Successfully deleted user!');
        return redirect()->route('user.index');
    }
}
