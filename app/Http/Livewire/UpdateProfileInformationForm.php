<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Department;
use App\Models\City;
use App\Models\User;

class UpdateProfileInformationForm extends Component
{
    use WithFileUploads;

    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];

    /**
     * The new avatar for the user.
     *
     * @var mixed
     */
    public $photo;

    /**
     * Determine if the verification email was sent.
     *
     * @var bool
     */
    public $verificationLinkSent = false;

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $user = Auth::user();

        $this->state = array_merge([
            'email' => $user->email,
        ], $user->withoutRelations()->toArray());
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Laravel\Fortify\Contracts\UpdatesUserProfileInformation  $updater
     * @return void
     */
    public function updateProfileInformation(UpdatesUserProfileInformation $updater)
    {
        $this->resetErrorBag();
        $this->state['city'] = (int)$this->state['city'];
        $this->state['email'] = Auth::user()->email;

        $updater->update(
            Auth::user(),
            $this->photo
                ? array_merge($this->state, ['photo' => $this->photo])
                : $this->state
        );

        if (isset($this->photo)) {
            return redirect()->route('profile.show');
        }

        $this->emit('saved');

        $this->emit('refresh-navigation-menu');
    }

    /**
     * Delete user's profile photo.
     *
     * @return void
     */
    // public function deleteProfilePhoto()
    // {
    //     Auth::user()->deleteProfilePhoto();

    //     $this->emit('refresh-navigation-menu');
    // }

    /**
     * Sent the email verification.
     *
     * @return void
     */
    // public function sendEmailVerification()
    // {
    //     Auth::user()->sendEmailVerificationNotification();

    //     $this->verificationLinkSent = true;
    // }

    public $estado = [
        'department' => null,
        'city' => null,
    ];

    public $cities = [];

    public function getCities()
    {
        if ($this->estado['department']) {
            $cities = City::where('cities.department', $this->estado['department'])->get();
            $this->cities = $cities;
        } else {
            $this->cities = [];
        }
    }

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::user();
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $departments = Department::select('id', 'name')->get();
        $userCityAndDepartment = User::select('users.city as city', 'departments.id as department')
            ->from('users')
            ->JOIN('cities','users.city', 'cities.id')
            ->JOIN('departments','cities.department', 'departments.id')
            ->where('users.id', Auth::user()->id)
            ->first();

        if (!$this->estado['department']) {
                $this->estado['department'] = $userCityAndDepartment->department;
        }
        $this->getCities();

        return view('profile.update-profile-information-form', compact('departments', 'userCityAndDepartment'));
    }
}
