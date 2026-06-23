@extends('layouts.app')

@section('content')
    <h2>Kelola Pengguna</h2>
    
    <table border="1" cellpadding="8" style="border-collapse: collapse; width: 100%;">
        <thead style="background-color: #f4f4f4;">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Role</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->full_name }}</td>
                    <td style="max-width: 3rem;">
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <span>{{ ucwords($user->role) }}</span>
    
                                <form 
                                    id="roleForm_{{ $user->id }}" 
                                    method="POST" 
                                    action="{{ route('role.update') }}"
                                    style="display: none; gap: 1rem;"
                                >
                                    @csrf
                                    @method('PUT')
                                    
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    
                                    <select name="role">
                                        <option value="user">User</option>
                                        <option value="staff">Staff</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                    
                                    <button type="submit">
                                        Save
                                    </button>
                                </form>
                            </div>

                            <button 
                                class="roleButton" 
                                style="place-self: end;"
                                onclick="toggleRoleForm({{ $user->id }})"
                                type="button"
                            >
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                        </div>
                    </td>
                    <td>{{ $user->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function toggleRoleForm(userId) {
            const form = document.getElementById(`roleForm_${userId}`);
            if (form.style.display === 'none') {
                form.style.display = 'flex';
            } else {
                form.style.display = 'none';
            }
        }
    </script>
@endsection