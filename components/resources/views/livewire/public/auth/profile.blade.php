<div>
    <section id="reset-password-page">
        <div class="page-wrapper page-center">
            <div class="container-xl py-4">

                <div class="page-body">
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <div class="card">
                                <div class="card-body">

                                    <div class="avatar avatar-xl position-relative d-block mx-auto">
                                        <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim(Auth::user()->email))) }}?s=150&d=mm&r=g" alt="Avatar" class="w-100 border-radius-lg shadow-sm">
                                        <a href="https://gravatar.com" class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2 edit-avatar" target="_blank">
                                            <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Edit Image') }}" data-bs-original-title="{{ __('Edit Image') }}" aria-label="{{ __('Edit Image') }}"></i>
                                        </a>
                                    </div>

                                    <div class="d-flex flex-column align-items-center text-center">
                                        <div class="mt-3">
                                            <h5>{{ Auth::user()->fullname }}</h5>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col font-weight-bold text-secondary">{{ __('Join Date') }}: <span class="float-end text-success">{{ \Carbon\Carbon::parse( Auth::user()->created_at )->format('F j, Y') }}</span></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">

                                    <!-- Session Status -->
                                    <x-auth-session-status class="mb-4" :status="session('status')" />

                                    <!-- Validation Errors -->
                                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
            
                                    <form role="form" wire:submit.prevent="onUpdateProfile">

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <label class="col-form-label text-sm">{{ __('Full name') }}:</label>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="fullname" wire:model.defer.lazy="fullname" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <label class="col-form-label text-sm">{{ __('Email') }} (*):</label>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="email" name="user_email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <label class="col-form-label text-sm">{{ __('New Password') }} (*):</label>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Enter password') }}" type="password" wire:model.defer="password" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <label class="col-form-label text-sm">{{ __('Confirm New Password') }} (*):</label>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="{{ __('Enter confirm password') }}" type="password" wire:model.defer="password_confirmation" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <button type="submit" class="btn bg-gradient-primary bg-gradient-submit mb-0" wire:loading.attr="disabled">
                                                    <span>
                                                      <div wire:loading wire:target="onUpdateProfile">
                                                        <x-loading />
                                                      </div>
                                                      <span>{{ __('Save Changes') }}</span>
                                                    </span>
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
        </div>
    </section>
</div>