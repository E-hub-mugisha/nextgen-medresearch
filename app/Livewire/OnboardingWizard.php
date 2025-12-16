<?php

namespace App\Livewire;

use App\Models\ResearchInterest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class OnboardingWizard extends Component
{
    public $step = 1;
    public $role, $name, $email, $password, $password_confirmation, $interests = [];

    public $researchInterests;

    public function mount()
    {
        $this->researchInterests = ResearchInterest::all();
    }

    public function nextStep()
    {
        $this->validateStep();
        $this->step++;
    }

    public function prevStep()
    {
        $this->step--;
    }

    public function validateStep()
    {
        if ($this->step == 1) {
            $this->validate(['role' => 'required|in:mentee,mentor']);
        }
        if ($this->step == 2) {
            $this->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed',
            ]);
        }
        if ($this->step == 3) {
            $this->validate([
                'interests' => 'required|array|min:1',
            ]);
        }
    }

    public function submit()
    {
        $this->validateStep();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'password' => Hash::make($this->password),
        ]);

        $user->researchInterests()->sync($this->interests);

        auth()->login($user);

        session()->flash('success', 'Registration Completed!');

        return redirect()->route('mentors.list');
    }

    public function render()
    {
        return view('livewire.onboarding-wizard', [
            'researchInterests' => ResearchInterest::all()
        ]);
    }
}
