{{-- @extends('layouts.sidebar') --}}
@extends('layouts.sidebar')

@section("navLinks")
<li>
    <a href="users" data-id="emploi" title="emploi" class="tooltip">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-dashboard" width="24"
        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
        stroke-linejoin="round" aria-hidden="true">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M4 4h6v8h-6z" />
        <path d="M4 16h6v4h-6z" />
        <path d="M14 12h6v8h-6z" />
        <path d="M14 4h6v4h-6z" />
      </svg>
      <span class="link hide">Gerer les utilisateurs</span>
      <span class="tooltip__content">Gerer les utilisateurs</span>
    </a>
  </li>
  <li>
    <a href="salles" data-id="emploi" title="emploi" class="tooltip">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-dashboard" width="24"
        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
        stroke-linejoin="round" aria-hidden="true">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M4 4h6v8h-6z" />
        <path d="M4 16h6v4h-6z" />
        <path d="M14 12h6v8h-6z" />
        <path d="M14 4h6v4h-6z" />
      </svg>
      <span class="link hide">Gerer les salles</span>
      <span class="tooltip__content">Gerer les salles</span>
    </a>
  </li>
  <li>
    <a href="classes" data-id="emploi" title="emploi" class="tooltip">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-dashboard" width="24"
        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
        stroke-linejoin="round" aria-hidden="true">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M4 4h6v8h-6z" />
        <path d="M4 16h6v4h-6z" />
        <path d="M14 12h6v8h-6z" />
        <path d="M14 4h6v4h-6z" />
      </svg>
      <span class="link hide">Gerer les classes</span>
      <span class="tooltip__content">Gerer les classes</span>
    </a>
  </li>
  <li>
    <a href="formation" data-id="emploi" title="emploi" class="tooltip">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-dashboard" width="24"
        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
        stroke-linejoin="round" aria-hidden="true">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M4 4h6v8h-6z" />
        <path d="M4 16h6v4h-6z" />
        <path d="M14 12h6v8h-6z" />
        <path d="M14 4h6v4h-6z" />
      </svg>
      <span class="link hide">Gerer les formations</span>
      <span class="tooltip__content">Gerer les formations</span>
    </a>
  </li>
@endsection

@extends('Educational_Service.home')

@section("content")
<div class="users-container">

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
    <button class="btn" id="toggleFormButton">Add New User</button>

</div>

<div id="formLayoutt" class="form-layoutt">
    <div class="roww justify-content-centerr">
        <div class="col-md-8">
            <div class="cardd">
                {{-- <div class="card-header">{{ __('Register') }}</div> --}}

                <div class="form-container">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row mb-3">
                        <label>User Type :</label>
                            <select name="user_role" class = "form-control">
                                <option value="1">Etudiant</option>
                                <option value="2">Professeur</option>
                                <option value="3">Chef de Filiere</option>
                                <option value="4">Chef de departement</option>
                                <option value="5">Responsable de scolarite</option>
                            </select>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="registerBtn btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@vite(["resources/js/users-form.js"])
@vite(["resources/js/home.js"])


@endsection
