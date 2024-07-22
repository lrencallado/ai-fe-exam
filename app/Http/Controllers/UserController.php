<?php

namespace App\Http\Controllers;

use App\Enums\Type;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->user()->type === Type::EDITOR->value) {
            return Inertia::render('User/Index', [
                'users' => User::where('id', '!=', $request->user()->id)->paginate(6)
            ]);
        }

        return redirect()->back()->dangerBanner('You don\'t have permission to view this page.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('User/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request, UserRepository $userRepository)
    {
        $userRepository->createOtherUser($request->all());

        $request->session()->flash('flash.banner', 'New User was created successfully!');

        return;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return Inertia::render('User/Edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user)
    {
        $user->update($request->all());

        $request->session()->flash('flash.banner', 'Updated successfully!');

        return;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
