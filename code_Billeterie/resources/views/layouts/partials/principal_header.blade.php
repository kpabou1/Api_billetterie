<header class="mdc-top-app-bar">
  <div class="mdc-top-app-bar__row">
    <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
      <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button sidebar-toggler">menu</button>
      <span class="mdc-top-app-bar__title"></span>
     
    </div>
    <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end mdc-top-app-bar__section-right">
      <div class="menu-button-container menu-profile d-none d-md-block">
        <button class="mdc-button mdc-menu-button">
          <span class="d-flex align-items-center">
            <span class="figure">
              <img src="{{ asset('assets_2/assets/images/faces/face1.jpg') }}" alt="user" class="user">

            </span>
            <span class="user-name"> {{ Auth::user()->username }}</span>
          </span>
        </button>
        <div class="mdc-menu mdc-menu-surface" tabindex="-1">
          <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
            <li class="mdc-list-item" role="menuitem">
              <div class="item-thumbnail item-thumbnail-icon-only">
                <i class="mdi mdi-account-edit-outline text-primary"></i>
              </div>
              <div class="item-content d-flex align-items-start flex-column justify-content-center">
                <a href="{{ url('/profile') }}" class="item-subject font-weight-normal">Profile</a>
              </div>
              
            </li>
            <li class="mdc-list-item" role="menuitem">
              <div class="item-thumbnail item-thumbnail-icon-only">
                <i class="mdi mdi-logout-variant text-primary"></i>
              </div>
              <div class="item-content d-flex align-items-start flex-column justify-content-center">


                <h6 class="item-subject font-weight-normal">
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
  
                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
  
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
                </h6>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="divider d-none d-md-block"></div>

     
    </div>
  </div>
</header>