<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        if($input['address'] == null) {
            $input['address'] = "";
        }
        if ($input['phone'] == null) {
            $input['phone'] = "";
        }
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:40', 'regex:/^[^0-9]+$/'],
            'last_name' => ['required', 'string', 'max:40', 'regex:/^[^0-9]+$/'],
            'address' => ['string', 'max:95'],
            'city' => ['required', 'numeric', 'min:1'],
            'phone' => ['string', 'max:11', 'min:10'],
            'email' => ['required', 'email', 'max:95', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'address' => $input['address'],
                'city' => $input['city'],
                'phone' => $input['phone'],
                'email' => $input['email'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'first_name' => $input['name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'address' => $input['address'],
            'phone' => $input['phone'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
