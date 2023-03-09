<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Shows the profile data.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = auth()->user();

        $genders = [
            'Undefined' => __('Undefined'),
            'Male'      => __('Male'),
            'Female'    => __('Female'),
        ];

        return view('user.show', compact('user', 'genders'));
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
            'name'           => 'required|string|max:255',
            'email'          => 'required|string|email|max:255|unique:users,email,' . $id,
            'gender'         => 'nullable',
            'message_color'  => 'nullable'
        ]);

        $this->userRepository->update($id, $fields);

        return response()->json(['status_message' => __('You updated your data correctly.')], 200);
    }
}
