<x-layout title="Edit Profile">
    <div class="space-y-stack-lg">
        <div class="glass-card rounded-xl p-8 max-w-3xl mx-auto animate-in fade-in duration-500">
            <div class="flex flex-col gap-4 mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="font-headline-lg text-headline-lg text-on-surface">Edit Profile</h1>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-2">Update your account details and
                            avatar.</p>
                    </div>
                    <a href="{{ route('profile.index') }}"
                        class="px-4 py-2 rounded-lg border border-outline-variant text-on-surface-variant hover:bg-surface-container font-label-md text-label-md transition-all">Back
                        to profile</a>
                </div>

                @if ($errors->any())
                    <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <form action="{{ route('profile.edit') }}" method="POST" enctype="multipart/form-data"
                class="space-y-stack-lg">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-lg">
                    <div>
                        <label
                            class="font-label-md text-label-md text-on-surface-variant block mb-stack-sm uppercase tracking-wider"
                            for="name">Full Name</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}"
                            class="w-full rounded-xl border border-outline-variant bg-surface-container px-4 py-3 font-body-md text-body-md outline-none transition-all focus:border-primary focus:ring-1 focus:ring-primary"
                            required>
                    </div>

                    <div>
                        <label
                            class="font-label-md text-label-md text-on-surface-variant block mb-stack-sm uppercase tracking-wider"
                            for="email">Email Address</label>
                        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}"
                            class="w-full rounded-xl border border-outline-variant bg-surface-container px-4 py-3 font-body-md text-body-md outline-none transition-all focus:border-primary focus:ring-1 focus:ring-primary"
                            required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-lg">
                    <div>
                        <label
                            class="font-label-md text-label-md text-on-surface-variant block mb-stack-sm uppercase tracking-wider"
                            for="username">Username</label>
                        <input id="username" name="username" type="text"
                            value="{{ old('username', $user->username) }}"
                            class="w-full rounded-xl border border-outline-variant bg-surface-container px-4 py-3 font-body-md text-body-md outline-none transition-all focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    <div>
                        <label
                            class="font-label-md text-label-md text-on-surface-variant block mb-stack-sm uppercase tracking-wider"
                            for="avatar">Avatar Image</label>
                        <div class="flex items-center gap-4">
                            <img src="{{ $user->avatar_url }}" alt="Avatar preview"
                                class="w-20 h-20 rounded-full object-cover border border-outline-variant">
                            <input id="avatar" name="avatar" type="file" accept="image/*"
                                class="w-full text-sm text-on-surface-variant file:mr-4 file:rounded-full file:border-0 file:bg-primary file:px-4 file:py-2 file:text-white file:font-medium file:hover:cursor-pointer file:hover:opacity-90">
                        </div>
                    </div>
                </div>

                <div class="pt-stack-md flex flex-col sm:flex-row items-center justify-end gap-stack-md">
                    <a href="{{ route('profile.index') }}"
                        class="w-full sm:w-auto px-6 py-2.5 rounded-lg border border-outline-variant text-on-surface-variant hover:bg-surface-container font-label-md text-label-md transition-colors text-center">Cancel</a>
                    <button type="submit"
                        class="w-full sm:w-auto px-6 py-2.5 rounded-lg bg-primary text-on-primary font-bold hover:opacity-90 active:scale-95 font-label-md text-label-md transition-all shadow-sm">Save
                        Changes</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
