@extends('layouts.main')

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Ajouter un utilisateur</h2>

    <form method="POST" action="{{ route('users.store') }}" class="space-y-4">
        @csrf
        <input type="text" name="name" placeholder="Nom" class="w-full p-2 border rounded" required>
        <input type="email" name="email" placeholder="Email" class="w-full p-2 border rounded" required>
        <input type="password" name="password" placeholder="Mot de passe" class="w-full p-2 border rounded" required>

        <select name="role" class="w-full p-2 border rounded" required>
            <option value="">-- Choisir un rôle --</option>
            <option value="etudiant">Étudiant</option>
            <option value="gestionnaire">Gestionnaire</option>
            <option value="admin">Admin</option>
            <option value="superadmin">Superadmin</option>
        </select>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Enregistrer</button>
    </form>
</div>
@endsection
