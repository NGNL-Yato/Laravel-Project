{{-- @extends('layouts.sidebar') --}}
@extends('layouts.sidebar')
@extends('Educational_Service.home')


@section('content')
<button id="toggleFormButton">Add New User</button>

<div class = "container">
    <div>
        <table>
            <thead class="table__thead">
                <tr>
                    <th  class="table__th">ID</th> 
                    <th  class="table__th">Name</th>
                    <th  class="table__th">Email</th>
                    <th  class="table__th">Role</th>
                    <th  class="table__th">Action</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                @foreach ($users as $user)
                    <tr class="table-row">
                        <td class="table-row__td">{{ $user->id }}</td>
                        <td class="table-row__td">{{ $user->name }}</td>
                        <td class="table-row__td">{{ $user->email }}</td>
                        <td class="table-row__td">{{ $user->role }}</td>
                        <td class="table-row__td action-td">
                            <button type="button" class="edit-btn" data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}" data-user-email="{{ $user->email }}" data-user-role="{{ $user->role }}">
                                <svg  version="1.1" class="table-row__edit" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve" data-toggle="tooltip" data-placement="bottom" title="Edit"><g>	<g>		<path d="M496.063,62.299l-46.396-46.4c-21.2-21.199-55.69-21.198-76.888,0l-18.16,18.161l123.284,123.294l18.16-18.161    C517.311,117.944,517.314,83.55,496.063,62.299z" style="fill: rgb(1, 185, 209);"></path>	</g></g><g>	<g>
                                    <path d="M22.012,376.747L0.251,494.268c-0.899,4.857,0.649,9.846,4.142,13.339c3.497,3.497,8.487,5.042,13.338,4.143    l117.512-21.763L22.012,376.747z" style="fill: rgb(1, 185, 209);"></path>	</g></g><g>	<g>		<polygon points="333.407,55.274 38.198,350.506 161.482,473.799 456.691,178.568   " style="fill: rgb(1, 185, 209);"></polygon>	</g></g><g></g><g></g><g></g>
                            <g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                            </button>
                            <form action="{{ route('user.delete', $user->id) }}" method="post">
                                {{--Get the user id so use it on the delete method inside the
                                    the UserController--}}
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <svg data-toggle="tooltip" data-placement="bottom" title="Delete" version="1.1" class="table-row__bin" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g>	<g>		<path d="M436,60h-90V45c0-24.813-20.187-45-45-45h-90c-24.813,0-45,20.187-45,45v15H76c-24.813,0-45,20.187-45,45v30    c0,8.284,6.716,15,15,15h16.183L88.57,470.945c0.003,0.043,0.007,0.086,0.011,0.129C90.703,494.406,109.97,512,133.396,512    h245.207c23.427,0,42.693-17.594,44.815-40.926c0.004-0.043,0.008-0.086,0.011-0.129L449.817,150H466c8.284,0,15-6.716,15-15v-30    C481,80.187,460.813,60,436,60z M196,45c0-8.271,6.729-15,15-15h90c8.271,0,15,6.729,15,15v15H196V45z M393.537,468.408    c-0.729,7.753-7.142,13.592-14.934,13.592H133.396c-7.792,0-14.204-5.839-14.934-13.592L92.284,150h327.432L393.537,468.408z     M451,120h-15H76H61v-15c0-8.271,6.729-15,15-15h105h150h105c8.271,0,15,6.729,15,15V120z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g>	<g>		<path d="M256,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C271,186.716,264.284,180,256,180z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g>	<g>		<path d="M346,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C361,186.716,354.284,180,346,180z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g>	<g>		<path d="M166,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C181,186.716,174.284,180,166,180z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                                        <g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                                    </svg> 
                                </button>
                            </form>
                        </td>                
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div id="editForm" class="modal">
            <div class="modal-content">
            <form id="editUserForm" action="{{ route('user.update', $user->id) }}" method="post">
                @csrf
                @method('PUT')

                <div>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="">
                </div>

                <div>
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" value="">{{--Choose type text instead of email to facilite the task--}}
                </div>

                <div>
                    <label for="role">Role:</label>
                    <select id="role" name="role">
                        <option value="1">Etudiant</option>
                        <option value="2">Professeur</option>
                    </select>
                </div>

                <button type="submit">Save Changes</button>
                <button type="button" class="cancel-btn">Cancel</button>
            </form>
        </div>
    </div>
    </div>

    @include('Educational_Service.register')
</div>
@endsection
