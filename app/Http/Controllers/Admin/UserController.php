<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->getAllSort('id', 'desc', true);

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->userRepository->getAllRoles()->prepend(__('Select a role'));
        
        $accountStatus = $this->userRepository->getAllAccountStatus()->prepend(__('Select a status'));

        return view('admin.user.create', compact('roles', 'accountStatus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name'           => 'required|string|max:255|unique:users',
            'email'          => 'required|string|email|max:255|unique:users',
            'password'       => 'required|string|min:8|confirmed',
            'role'           => ['required', Rule::in($this->userRepository->getAllRoles()->keys())],
            'account_status' => ['required', Rule::in($this->userRepository->getAllAccountStatus()->keys())]
        ], [
            'name.unique' => __('The :attribute entered is already in use.')
        ]);

        $this->userRepository->create($fields);

        return redirect()->route('admin.user.index')->with('success', __('User created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = $this->userRepository->findById($user->id)
            ->load(['messages', 'messages.reports']);

        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = $this->userRepository->findById($user->id);
        $user->role = $user->is_admin ? 1 : 2;
        $user->account_status = $user->is_banned ? 2 : 1;

        $roles = $this->userRepository->getAllRoles()->prepend(__('Select a role'));
        
        $accountStatus = $this->userRepository->getAllAccountStatus()->prepend(__('Select a status'));

        return view('admin.user.edit', compact('user', 'roles', 'accountStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $fields = $request->validate([
            'name'           => 'required|string|max:255|unique:users,name,' .  $user->id,
            'email'          => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role'           => ['required', Rule::in($this->userRepository->getAllRoles()->keys())],
            'account_status' => ['required', Rule::in($this->userRepository->getAllAccountStatus()->keys())]
        ], [
            'name.unique' => __('The :attribute entered is already in use.')
        ]);

        $this->userRepository->update($user->id, $fields);

        return redirect()->route('admin.user.index')->with('success', __('The user data has been successfully updated.'));
    }

    /**
     * Show delete modal.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function delete(User $user)
    {
        if (! request()->ajax())
            abort(404);

        $user = $this->userRepository->findById($user->id);

        return view('admin.user.partials._delete', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->userRepository->delete($user->id);

        return response()->json(null, 204);
    }

    /**
     * Updates a user's account status (Banned, Unbanned).
     *
     * @param  \App\User  $user
     * @param  bool  $status
     * @return \Illuminate\Http\Response
     */
    public function updateBanStatus(User $user, $status)
    {
        $this->userRepository->updateIsBannedStatusFromUser($user->id, $status);

        $message = $status ? __('The user has been banned.') : __('The user has been unbanned.');

        return redirect()->route('admin.user.show', $user)->with('success', $message);
    }
}
