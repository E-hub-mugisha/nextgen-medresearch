<div class="container mt-5">
    <div class="card p-4">
        <h4 class="mb-4">Research Portal Registration</h4>

        @if(session()->has('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($step == 1)
        <div>
            <label>Select Role:</label>
            <div class="form-check">
                <input type="radio" wire:model="role" value="mentee" class="form-check-input"> Mentee
            </div>
            <div class="form-check">
                <input type="radio" wire:model="role" value="mentor" class="form-check-input"> Mentor
            </div>
            @error('role') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        @endif

        @if($step == 2)
        <div>
            <input type="text" wire:model="name" placeholder="Full Name" class="form-control mb-2">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror

            <input type="email" wire:model="email" placeholder="Email" class="form-control mb-2">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror

            <input type="password" wire:model="password" placeholder="Password" class="form-control mb-2">
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror

            <input type="password" wire:model="password_confirmation" placeholder="Confirm Password" class="form-control mb-2">
        </div>
        @endif

        @if($step == 3)
        <div>
            <label>Select Research Interests:</label>
            @foreach($researchInterests as $interest)
            <div class="form-check">
                <input type="checkbox" wire:model="interests" value="{{ $interest->id }}" class="form-check-input">
                {{ $interest->name }}
            </div>
            @endforeach
            @error('interests') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        @endif

        <div class="mt-4">
            @if($step > 1)
            <button wire:click="prevStep" class="btn btn-secondary">Back</button>
            @endif

            @if($step < 3)
            <button wire:click="nextStep" class="btn btn-primary">Next</button>
            @else
            <button wire:click="submit" class="btn btn-success">Finish</button>
            @endif
        </div>
    </div>
</div>
