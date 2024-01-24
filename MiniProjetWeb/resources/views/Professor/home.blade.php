@extends('layouts.sidebar')
@section("navLinks")
<li>
    <a href="{{URL('Professor/announces')}}" data-id="emploi" title="emploi" class="tooltip">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-dashboard" width="24"
        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
        stroke-linejoin="round" aria-hidden="true">
            {{-- Elements of style (the squares) --}}
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M4 4h6v8h-6z" />
        <path d="M4 16h6v4h-6z" />
        <path d="M14 12h6v8h-6z" />
        <path d="M14 4h6v4h-6z" />
      </svg>
      <span class="link hide">Les announces</span>
    </a>
    </li>
    <li>
      <a href="http://localhost:8000/Professor/annonces" data-id="emploi" title="emploi" class="tooltip">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-dashboard" width="24"
          height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
          stroke-linejoin="round" aria-hidden="true">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M4 4h6v8h-6z" />
          <path d="M4 16h6v4h-6z" />
          <path d="M14 12h6v8h-6z" />
          <path d="M14 4h6v4h-6z" />
        </svg>
        <span class="link hide">Demandes</span>
      </a>
    </li>
  <li>
    <a href="{{URL('Professor/emploi')}}" data-id="emploi" title="emploi" class="tooltip">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-dashboard" width="24"
        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
        stroke-linejoin="round" aria-hidden="true">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M4 4h6v8h-6z" />
        <path d="M4 16h6v4h-6z" />
        <path d="M14 12h6v8h-6z" />
        <path d="M14 4h6v4h-6z" />
      </svg>
      <span class="link hide">L'emploi de temps</span>
    </a>
  </li>
  <li>
    <a href="{{URL('Professor/indexDemande')}}" data-id="emploi" title="emploi" class="tooltip">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-dashboard" width="24"
        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
        stroke-linejoin="round" aria-hidden="true">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M4 4h6v8h-6z" />
        <path d="M4 16h6v4h-6z" />
        <path d="M14 12h6v8h-6z" />
        <path d="M14 4h6v4h-6z" />
      </svg>
      <span class="link hide">Les Demandes</span>
    </a>
  </li>  
@endsection

