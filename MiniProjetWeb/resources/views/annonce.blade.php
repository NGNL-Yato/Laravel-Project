<div class="announcements-posts">
    @if($annonces->count() > 0)
        @foreach($annonces as $annonce)
            <!-- Affichage des informations de l'annonce -->
            <div class="post">
                <div class="imgBx">
                    <img src="{{URL('assets/hero.png')}}" alt="">
                </div>
                <div class="post-info">
                    <span class="sous-title">Nouvelle annonce !</span>
                    <h4 class="post-title">{{ $annonce->titre_annonce }}</h4>
                    <p class="post-date">{{ $annonce->created_at->format('d F Y') }}</p>
                    <p class="post-text">{{ $annonce->contenu_annonce }}</p>
                </div>
            </div>
        @endforeach
    @else
        <p>Aucune annonce disponible pour le moment.</p>
    @endif
</div>
