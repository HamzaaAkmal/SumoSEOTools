<footer class="footer py-5">
    <div class="container-fluid">
        <div class="row text-center align-items-center flex-row-reverse">
            <div class="col-lg-auto ms-lg-auto">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://closes.link" class="nav-link text-muted" target="_blank">{{ __('About Us') }}</a>
                </li>
                <li class="nav-item">
                  <a href="https://closes.link" class="nav-link pe-0 text-muted" target="_blank">{{ __('Admin') }}</a>
                </li>
              </ul>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                  © {{ date('Y') }} <a href="https://closes.link" class="font-weight-bold" target="_blank">{{ __('Created by Hamza Akmal') }}</a> | 
                  {{ __('Made with') }} <span id="heart"><i class="fa fa-heart"></i></span> {{ __('for a better web.') }}
                </ul>
            </div>
        </div>
    </div>
</footer>
