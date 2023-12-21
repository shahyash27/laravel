<x-app-layout>
<div class="min-h-screen flex flex-col sm:justiy-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
    <h1 class="text-lg font-bold">Create Ticket</h1>
    <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hiddensm:round-lg">
    <form method="POST" action="{{ route('ticket.store') }}" enctype="multipart/form-data">
        @csrf
        <!-- Title -->
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" autofocus autocomplete="title" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <!-- Description -->
        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-textarea id="description" class="block mt-1 w-full" name="description" value="" autofocus autocomplete="description"/>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <!-- Attachment -->
        <div>
            <x-input-label for="attachment" :value="__('Attachment')" />
            <x-file-input id="attachment" class="block mt-1 w-full" name="attachment" :value="old('attachment')" autofocus autocomplete="attachment" />
            <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
        </div>
        
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-3">
                {{ __('Create Ticket') }}
            </x-primary-button>
        </div>
    </form>
</div>
<x-nav-link href="{{route('ticket.index')}}"><--Back</x-nav-link>
</div>
</x-app-layout>