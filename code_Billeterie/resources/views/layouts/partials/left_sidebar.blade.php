<aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open">
    <div class="mdc-drawer__header">
      <a href="{{ route('dashboard') }}" class="brand-logo">
        <img src="{{ asset(config('app.logo')) }}" alt="logo" width="200" height="100">

      </a>
    </div>
    <div class="mdc-drawer__content">
      <div class="user-info">
        <p class="name"> {{ Auth::user()->username }}</p>
        <p class="email">
          {{ Auth::user()->email }}
        </p>
      </div>
      <div class="mdc-list-group">
        <nav class="mdc-list mdc-drawer-menu">
          <div class="mdc-list-item mdc-drawer-item">
            <a class="mdc-drawer-link" href="{{ route('dashboard') }}">
              <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">home</i>
              Tableau de bord
            </a>
          </div>
          <div class="mdc-list-item mdc-drawer-item">
            <a class="mdc-drawer-link" href="{{ route('welcome') }}">
              <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">home</i>
              Acceuil
            </a>
          </div>

          <div class="mdc-list-item mdc-drawer-item">
            <a class="mdc-drawer-link" href="{{ route('events.index') }}">
              <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">track_changes</i>
              EVENTS
            </a>
          </div>
          <div class="mdc-list-item mdc-drawer-item">
            <a class="mdc-drawer-link" href="{{ route('suivi_marches.index') }}">
              <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">pie_chart_outlined</i>
              Suivie Contrat
            </a>
          </div>

          <div class="mdc-list-item mdc-drawer-item">
            <a class="mdc-drawer-link" href="{{ route('annees.index') }}" >
              <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">description</i>
              Gerer Année
            </a>
          </div>
          <div class="mdc-list-item mdc-drawer-item">
            <a class="mdc-drawer-link" href="{{ route('statistiques.index') }}">
              <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">dashboard</i>
              Statistiques
            </a>
          </div>
          <div class="mdc-list-item mdc-drawer-item">
            <a class="mdc-drawer-link" href="{{ route('background_image.edit') }}">
              <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">pages</i>
                            Parametrage
            </a>
          </div>

          <div hidden class="mdc-list-item mdc-drawer-item">
            <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="ui-sub-menu">
              <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">dashboard</i>
              Données
                            <i class="mdc-drawer-arrow material-icons">chevron_right</i>
            </a>
            <div hidden class="mdc-expansion-panel" id="ui-sub-menu">
              <nav class="mdc-list mdc-drawer-submenu">
                <div class="mdc-list-item mdc-drawer-item">
                  <a class="mdc-drawer-link" href="{{ route('import.database') }}">
                    Importé donnée
                </a>

                </div>
                <div class="mdc-list-item mdc-drawer-item">
                  <a class="mdc-drawer-link"  href="{{ route('exports.done') }}">
                    Exporté donnée
                </a>
                </div>
              </nav>
            </div>
          </div>

          <div  hidden class="mdc-list-item mdc-drawer-item">
            <a class="mdc-drawer-link" href="{{ url('/users') }}">
              <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">pie_chart_outlined</i>
              Gerer utilisateur
            </a>
          </div>

        </nav>
      </div>
      <div class="profile-actions flex items-center space-x-4">
        <a href="https://isidoreportfolio.netlify.app/" target="_blank" class="text-blue-500 hover:underline">Isidore Kpabou</a>
        <span class="divider border-r border-gray-300 h-6"></span>
        <a href="https://isidoreportfolio.netlify.app/" target="_blank" class="text-blue-500 hover:underline">+228 91161396</a>
    </div>
    
    </div>
  </aside>
