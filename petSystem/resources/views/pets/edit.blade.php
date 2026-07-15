<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">Edit Pet Record</h2>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <section class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200 dark:bg-gray-800 dark:ring-gray-700">
                <form method="POST" action="{{ route('pets.update', $pet) }}" class="grid gap-5 md:grid-cols-2">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="pet_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Pet ID</label>
                        <input id="pet_id" name="pet_id" type="text" value="{{ old('pet_id', $pet->pet_id) }}" required maxlength="50" class="mt-1.5 block w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100" />
                        @error('pet_id')<p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Pet Name</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $pet->name) }}" required maxlength="100" class="mt-1.5 block w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100" />
                        @error('name')<p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="species" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Species</label>
                        <input id="species" name="species" type="text" value="{{ old('species', $pet->species) }}" required maxlength="100" class="mt-1.5 block w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100" />
                        @error('species')<p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status</label>
                        <select id="status" name="status" required class="mt-1.5 block w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100">
                            <option value="available" @selected(old('status', $pet->status) === 'available')>Available for Adoption</option>
                            <option value="adopted" @selected(old('status', $pet->status) === 'adopted')>Adopted</option>
                            <option value="foster" @selected(old('status', $pet->status) === 'foster')>Foster</option>
                        </select>
                        @error('status')<p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                    </div>

                    <div class="md:col-span-2 flex justify-end gap-3 pt-2">
                        <a href="{{ route('dashboard') }}" class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700">Cancel</a>
                        <button type="submit" class="rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500">Save Changes</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-app-layout>
