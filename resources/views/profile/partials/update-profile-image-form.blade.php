<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Image') }}
        </h2>

        <img height="50" width="50" class="rounded-full" src="{{"/storage/$user->profile_img"}}" alt="Profile Img"/>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile image.") }}
        </p>
    </header>

    @if(session('message'))
        <div class="alert alert-success">
            {{session('message')}}
        </div>
    @endif

    <form method="post" enctype="multipart/form-data" action="{{ route('profile.image') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="profile_img" :value="__('Profile Image')" />
            <x-text-input id="profile_img" name="profile_img" type="file" class="mt-1 block w-full" :value="old('profile_img', $user->profile_img)" autofocus autocomplete="profile_img" />
            <x-input-error class="mt-2" :messages="$errors->get('profile_img')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>