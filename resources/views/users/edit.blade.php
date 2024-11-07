<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white">
                    <h2 class="text-2xl font-semibold text-teal-700 mb-6">{{ __('Ubah Pengguna') }}</h2>
                    
                    <form action="{{ route('users.update', $user) }}" method="POST" id="editUserForm">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-teal-700">Nama</label>
                            <input type="text" name="name" id="name" value="{{ $user->name }}" class="mt-1 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required autofocus>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-teal-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ $user->email }}" class="mt-1 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-teal-700">Kata Sandi (kosongkan jika tidak ingin mengubah, minimal 8 karakter jika diisi)</label>
                            <input type="password" name="password" id="password" class="mt-1 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" minlength="8">
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-sm font-medium text-teal-700">Konfirmasi Kata Sandi</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 focus:ring-teal-500 focus:border-teal-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" minlength="8">
                        </div>
                        <div class="mb-4">
                            <label for="role" class="block text-sm font-medium text-teal-700">Peran</label>
                            <select id="role" name="role" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="bidan" {{ $user->role == 'bidan' ? 'selected' : '' }}>Bidan</option>
                                <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
                            </select>
                        </div>
                        <div class="flex items-center justify-between mt-4">
                            <a href="{{ route('users.index') }}" class="text-teal-600 hover:text-teal-800 transition duration-150 ease-in-out">Kembali</a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-teal-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-700 active:bg-teal-900 focus:outline-none focus:border-teal-900 focus:ring ring-teal-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Perbarui Pengguna
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="alertModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Peringatan
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Konfirmasi kata sandi harus sama dengan kata sandi.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm" id="closeAlertButton">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('editUserForm');
    const password = document.getElementById('password');
    const passwordConfirmation = document.getElementById('password_confirmation');
    const alertModal = document.getElementById('alertModal');
    const closeAlertButton = document.getElementById('closeAlertButton');

    form.addEventListener('submit', function(event) {
        if (password.value !== passwordConfirmation.value && password.value !== '') {
            event.preventDefault();
            alertModal.classList.remove('hidden');
        }
    });

    closeAlertButton.addEventListener('click', function() {
        alertModal.classList.add('hidden');
    });
});
</script>