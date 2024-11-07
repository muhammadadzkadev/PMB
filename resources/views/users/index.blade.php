<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white">
                    <h2 class="text-2xl font-semibold text-teal-700 mb-6">{{ __('Manajemen Pengguna') }}</h2>
                    
                    <div class="mb-4 flex justify-between items-center">
                        <a href="{{ route('users.create') }}" class="px-4 py-2 bg-teal-500 text-white rounded hover:bg-teal-600 transition duration-150 ease-in-out">Buat Pengguna Baru</a>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            <p class="font-bold">Berhasil</p>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-teal-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Peran</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-teal-700 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($users as $user)
                                <tr class="hover:bg-teal-50 transition duration-150 ease-in-out">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ ucwords(strtolower($user->name)) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ ucwords(strtolower($user->role)) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('users.edit', $user) }}" class="text-teal-600 hover:text-teal-900 mr-3">Ubah</a>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>