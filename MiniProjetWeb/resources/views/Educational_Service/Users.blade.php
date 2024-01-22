<div class = "users_educational_service_div">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <form action="{{ route('user.delete', $user->id) }}" method="post">
                            {{--Get the user id so use it on the delete method inside the
                                the UserController--}}
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                        <button type="button" class="edit-btn" data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}" data-user-email="{{ $user->email }}" data-user-role="{{ $user->role }}">Edit</button>
                    </td>                
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="editForm" class="hidden-edit-form">
        <form id="editUserForm" action="{{ route('user.update', $user->id) }}" method="post">
            @csrf
            @method('PUT')

            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="">
            </div>

            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="">
            </div>

            <div>
                <label for="role">Role:</label>
                <select id="role" name="role">
                    <option value="1">Etudiant</option>
                    <option value="2">Professeur</option>
                    <option value="3">Chef de Filiere</option>
                    <option value="4">Chef de departement</option>
                    <option value="5">Responsable de scolarite</option> 
                </select>
            </div>

            <button type="submit">Save Changes</button>
            <button type="button" class="cancel-btn">Cancel</button>
        </form>
    </div>
    @include('Educational_Service.register')
</div>

