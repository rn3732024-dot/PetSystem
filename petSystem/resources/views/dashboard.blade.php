<x-app-layout>
    <style>
        .dashboard-shell {
            position: relative;
            overflow: hidden;
            min-height: calc(100vh - 89px);
            background:
                radial-gradient(circle at top right, rgba(129, 140, 248, .38), transparent 30%),
                linear-gradient(135deg, #e0e7ff 0%, #dbeafe 48%, #fef3c7 100%);
        }
        .dashboard-pet-pattern { position: absolute; inset: 0; overflow: hidden; pointer-events: none; }
        .dashboard-pet-pattern span { position: absolute; opacity: .13; font-size: 5rem; }
        .dashboard-content { position: relative; z-index: 1; }
    </style>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">Pet Records Dashboard</h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Admin-only overview of shelter records</p>
            </div>
            <span class="rounded-full bg-indigo-100 px-3 py-1 text-xs font-semibold text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-200">Administrator</span>
        </div>
    </x-slot>

    <div class="dashboard-shell py-8 sm:py-12">
        <div class="dashboard-pet-pattern" aria-hidden="true">
            <span style="top: 5%; left: 3%; transform: rotate(-20deg);">🐾</span>
            <span style="top: 14%; right: 4%; transform: rotate(10deg);">🐶</span>
            <span style="top: 48%; left: 2%; transform: rotate(-8deg);">🐱</span>
            <span style="top: 58%; right: 5%; transform: rotate(22deg);">🐾</span>
            <span style="bottom: 4%; left: 12%; transform: rotate(-14deg);">🐰</span>
            <span style="bottom: 8%; right: 19%; transform: rotate(18deg);">🐾</span>
        </div>

        <div class="dashboard-content max-w-7xl mx-auto space-y-8 px-4 sm:px-6 lg:px-8">
            <section class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
                <article class="rounded-xl border border-blue-100 bg-white p-6 shadow-sm dark:border-blue-900/50 dark:bg-gray-800">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Registered Pets</p>
                    <p class="mt-3 text-3xl font-bold text-blue-600 dark:text-blue-400">{{ number_format($totalPets) }}</p>
                    <p class="mt-2 text-xs text-gray-400">All pets recorded in the system</p>
                </article>
                <article class="rounded-xl border border-emerald-100 bg-white p-6 shadow-sm dark:border-emerald-900/50 dark:bg-gray-800">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Available for Adoption</p>
                    <p class="mt-3 text-3xl font-bold text-emerald-600 dark:text-emerald-400">{{ number_format($availablePets) }}</p>
                    <p class="mt-2 text-xs text-gray-400">Pets ready for a new home</p>
                </article>
                <article class="rounded-xl border border-violet-100 bg-white p-6 shadow-sm dark:border-violet-900/50 dark:bg-gray-800">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Successfully Adopted</p>
                    <p class="mt-3 text-3xl font-bold text-violet-600 dark:text-violet-400">{{ number_format($adoptedPets) }}</p>
                    <p class="mt-2 text-xs text-gray-400">Pets marked as adopted</p>
                </article>
                <article class="rounded-xl border border-amber-100 bg-white p-6 shadow-sm dark:border-amber-900/50 dark:bg-gray-800">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">New Pets Added Today</p>
                    <p class="mt-3 text-3xl font-bold text-amber-600 dark:text-amber-400">{{ number_format($newPetsToday) }}</p>
                    <p class="mt-2 text-xs text-gray-400">{{ now()->format('F j, Y') }}</p>
                </article>
            </section>

            <section class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200 dark:bg-gray-800 dark:ring-gray-700">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Add Pet Record</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Enter a new pet record to update the dashboard.</p>
                </div>

                @if (session('success'))
                    <div class="mb-5 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 dark:border-emerald-800 dark:bg-emerald-950/40 dark:text-emerald-200" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('pets.store') }}" class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                    @csrf

                    <div>
                        <label for="pet_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Pet ID</label>
                        <input id="pet_id" name="pet_id" type="text" value="{{ old('pet_id') }}" placeholder="e.g. PET-001" required maxlength="50" class="mt-1.5 block w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100" />
                        @error('pet_id')<p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Pet Name</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="e.g. Bantay" required maxlength="100" class="mt-1.5 block w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100" />
                        @error('name')<p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="species" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Species</label>
                        <input id="species" name="species" type="text" value="{{ old('species') }}" placeholder="e.g. Dog, Cat, Rabbit" required maxlength="100" class="mt-1.5 block w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100" />
                        @error('species')<p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status</label>
                        <select id="status" name="status" required class="mt-1.5 block w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100">
                            <option value="available" @selected(old('status', 'available') === 'available')>Available for Adoption</option>
                            <option value="adopted" @selected(old('status') === 'adopted')>Adopted</option>
                            <option value="foster" @selected(old('status') === 'foster')>Foster</option>
                        </select>
                        @error('status')<p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                    </div>

                    <div class="md:col-span-2 xl:col-span-4 mt-1 flex justify-end">
                        <button type="submit" style="background-color: #4f46e5; color: #ffffff;" class="inline-flex items-center rounded-lg px-5 py-2.5 text-sm font-semibold shadow-sm transition hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                            Submit
                        </button>
                    </div>
                </form>
            </section>

            <section class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-200 dark:bg-gray-800 dark:ring-gray-700">
                <div class="border-b border-gray-200 px-6 py-5 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Latest Pet Records</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">The 10 most recently added pet records</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-900/40">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Pet ID</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Pet Name</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Species</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Added Date &amp; Time</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                            @forelse ($latestPets as $pet)
                                @php($statusClasses = match ($pet->status) {
                                    'available' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-200',
                                    'adopted' => 'bg-violet-100 text-violet-800 dark:bg-violet-900/50 dark:text-violet-200',
                                    default => 'bg-amber-100 text-amber-800 dark:bg-amber-900/50 dark:text-amber-200',
                                })
                                <tr>
                                    <td class="whitespace-nowrap px-6 py-4 font-mono text-sm text-gray-600 dark:text-gray-300">{{ $pet->pet_id }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $pet->name }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $pet->species }}</td>
                                    <td class="whitespace-nowrap px-6 py-4"><span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $statusClasses }}">{{ ucfirst($pet->status) }}</span></td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $pet->created_at->format('M j, Y, g:i A') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500 dark:text-gray-400">No pet records have been added yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
