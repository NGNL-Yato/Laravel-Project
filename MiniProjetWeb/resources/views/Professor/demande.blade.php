@include("Professor.home")
<div class="main-content">
    <div class="demande-container">
        <div class="demande-header">
            <h2 class="demande-title">Demande : {{ $demande->type_demande }}</h2>
            <div class="demande-info">
                <p>{{ $demande->created_at }}</p>               
                <p>{{ $demande->etat_demande }}</p>
            </div>
            <div class="user-icon">
                <img src="{{URL('assets/character.png')}}" alt="">
            </div>
        </div>
        <div class="demande-content">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quaerat fuga numquam asperiores excepturi? Nemo adipisci ipsa modi sit, laborum eaque atque qui beatae itaque placeat doloremque labore! Maiores, recusandae!</p>
            <div class="bottom-choices">
                <form id="editUserForm" action="{{ route('Professor.demande.update', $demande->id) }}" method="post">
                    @csrf
                    @method('PUT')
                
                    <div>
                        <label for="etat">Etat :</label>
                        <select id="etat" name="etat">
                            <option value="traite">traité</option>
                            <option value="refuse">Refusé</option>
                            <option value="encours">En Cours de traitement</option>
                        </select>
                    </div>
                
                    <button type="submit" class="btn">Save Changes</button>
                </form>
                
                
                </div>
            </div>
        </div>


    </div>




    {{-- 
    <p>{{ $demande->created_at }}</p>               
    <p>{{ $demande->etat_demande }}</p> --}}
</div>
