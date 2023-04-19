<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $user = auth()->user()->load('images');

        $genders = [
            'Undefined' => __('Undefined'),
            'Male'      => __('Male'),
            'Female'    => __('Female'),
        ];

        $images = $user->images()->paginate();

        return view('user.show', compact('user', 'genders', 'images'));
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
            'name'          => 'required|string|max:255',
            'gender'        => 'nullable',
            'message_color' => 'nullable'
        ]);

        $this->userRepository->update($id, $fields);

        return response()->json(['status_message' => __('You updated your data correctly.')], 200);
    }

    /**
     * Update a user's profile picture.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadProfilePicture(Request $request)
    {
        if (! $request->hasFile('profile_picture'))
            return response()->json(null, 500);

        $user = auth()->user();

        $file = $request->file('profile_picture');

        $this->userRepository->updateProfilePictureFromUser($user->id, $file);

        return response()->json(['status_message' => __('You changed your profile picture.')], 200);
    }
    
    /**
     * Change user's profile picture.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function changeProfilePicture(Request $request, \App\User $user)
    {
        if (empty($request->image_path))
            return back();

        $filename = explode('/', $request->image_path)[2];
        $userGalleryPath = "gallery/{$user->id}/";
        
        if (! Storage::exists($userGalleryPath . $filename))
            return back()->withErrors(__('This photo does not exist in your gallery.'));
        
        $user->profile_picture = $request->image_path;
        $user->save();
        
        return back()->with(['success' => __('You changed your profile picture.')]);
    }

    /**
     * Upload a user's photo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image'
        ]);

        $user = auth()->user();

        $file = $request->file('photo');

        $this->userRepository->uploadPhotoToUserGallery($user->id, $file);

        return back()->with(['success' => __('You have uploaded a photo to your gallery.')]);
    }
    
    /**
     * Delete a user's profile picture.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteProfilePicture()
    {
        $user = auth()->user();

        $this->userRepository->deleteProfilePictureFromUser($user->id);

        return response()->json(['status_message' => __('You deleted your profile picture.')], 200);
    }

    /**
     * Shows the change password view.
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        return view('user.change-password');
    }

    /**
     * Update the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $fields = $request->validate([
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();

        $this->userRepository->updatePasswordFromUser($user->id, $fields['new_password']);

        return redirect()->route('user.profile')->with('success', __('Updated password.'));
    }

    /**
     * Shows the account deactivation view.
     *
     * @return \Illuminate\Http\Response
     */
    public function deactivateAccount()
    {
        return view('user.deactivate-account');
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

        return redirect()->route('guest');
    }
}
