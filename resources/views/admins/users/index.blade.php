@extends('layouts.main')

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-semibold text-primary flex items-center gap-2">
            <i class="fas fa-users"></i> Gestion des utilisateurs
        </h2>
        <a href="{{ route('users.create') }}" class="bg-primary hover:bg-blue-700 text-white px-4 py-2 rounded-lg inline-flex items-center gap-2 shadow">
            <i class="fas fa-user-plus"></i> Ajouter
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4 flex items-center gap-2">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table id="usersTable" class="min-w-full table-auto border border-gray-200 rounded shadow-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left"><i class="fas fa-user"></i> Nom</th>
                    <th class="px-4 py-2 text-left"><i class="fas fa-envelope"></i> Email</th>
                    <th class="px-4 py-2 text-left"><i class="fas fa-id-badge"></i> Rôle</th>
                    <th class="px-4 py-2 text-right"><i class="fas fa-cogs"></i> Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @foreach($users as $user)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2">
                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded text-xs font-semibold
                            {{
                                $user->role === 'admin' ? 'bg-blue-100 text-blue-700' :
                                ($user->role === 'gestionnaire' ? 'bg-yellow-100 text-yellow-700' :
                                ($user->role === 'superadmin' ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-700'))
                            }}">
                            <i class="fas fa-user-shield"></i> {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-4 py-2 text-right flex justify-end gap-2">
                        <a href="{{ route('users.edit', $user) }}" class="bg-yellow-100 text-yellow-700 hover:bg-yellow-200 px-3 py-1 rounded-md text-sm flex items-center gap-1">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-100 text-red-600 hover:bg-red-200 px-3 py-1 rounded-md text-sm flex items-center gap-1">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#usersTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json'
            },
            responsive: true,
            pageLength: 10
        });
    });
</script>
@endpush
@endsection