@extends('layouts.main')

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Modifier l'utilisateur</h2>

    <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-4">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $user->name }}" class="w-full p-2 border rounded" required>
        <input type="email" name="email" value="{{ $user->email }}" class="w-full p-2 border rounded" required>

        <input type="password" name="password" placeholder="Nouveau mot de passe (facultatif)" class="w-full p-2 border rounded">

        <select name="role" class="w-full p-2 border rounded" required>
            <option value="etudiant" {{ $user->role === 'etudiant' ? 'selected' : '' }}>Étudiant</option>
            <option value="gestionnaire" {{ $user->role === 'gestionnaire' ? 'selected' : '' }}>Gestionnaire</option>
            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="superadmin" {{ $user->role === 'superadmin' ? 'selected' : '' }}>Superadmin</option>
        </select>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Mettre à jour</button>
    </form>
</div>
@endsection
