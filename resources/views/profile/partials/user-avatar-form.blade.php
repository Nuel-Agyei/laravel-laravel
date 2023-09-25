<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            User
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Add User Avatar
        </p>
    </header>

    @if (session('message'))
        <div class="text-green-500">
            {{session('message')}}
        </div>
    @endif
    <form action="{{route('profile.avatar')}}" method="POST">
        @method('patch')
        @csrf

      <div>
            <x-input-label for="name" :value="__('Avatar')" />
            <x-text-input id="avatar" name="avatar" type="file" class="mt-1 block w-full" :value="old('avatar', $user->avatar)" required autofocus autocomplete="avatar" />
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
            </div>
    </form>


        <div class="flex items-center gap-4 mt-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

        </div>
</section>
