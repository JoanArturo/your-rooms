<?php

namespace App\Http\Controllers\Admin;

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findById($id)
            ->load(['messages', 'messages.reports']);

        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->findById($id);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fields = $request->validate([
            'name'           => 'required|string|max:255|unique:users,name,' .  $id,
            'email'          => 'required|string|email|max:255|unique:users,email,' . $id,
            'role'           => ['required', Rule::in($this->userRepository->getAllRoles()->keys())],
            'account_status' => ['required', Rule::in($this->userRepository->getAllAccountStatus()->keys())]
        ], [
            'name.unique' => __('The :attribute entered is already in use.')
        ]);

        $this->userRepository->update($id, $fields);

        return redirect()->route('admin.user.index')->with('success', __('The user data has been successfully updated.'));
    }

    /**
     * Show delete modal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if (! request()->ajax())
            abort(404);

        $user = $this->userRepository->findById($id);

        return view('admin.user.partials._delete', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userRepository->delete($id);

        return response()->json(null, 204);
    }

    /**
     * Updates a user's account status (Banned, Unbanned).
     *
     * @param  int  $id
     * @param  bool  $status
     * @return \Illuminate\Http\Response
     */
    public function updateBanStatus($id, $status)
    {
        $this->userRepository->updateIsBannedStatusFromUser($id, $status);

        $message = $status ? __('The user has been banned.') : __('The user has been unbanned.');

        return redirect()->route('admin.user.show', $id)->with('success', $message);
    }
}
