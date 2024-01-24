@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="link-container col-md-4">
                <a href="{{URL('Educational_Service/emploi')}}" class="link-block">Salles</a>
            </div>
            <div class="link-container col-md-4">
                <a href="{{URL('Educational_Service/emploi')}}" class="link-block">Filières</a>
            </div>
        </div>
    </div>
@endsection

@include('Department_chief.home')