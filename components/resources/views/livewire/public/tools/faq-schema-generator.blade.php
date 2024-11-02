<div>

      <form wire:submit.prevent="onFaqSchemaGenerator">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="faq-contalner">
            <div class="faq border p-3 rounded shadow-sm mb-3 position-relative">
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('Question') }} #1</label>
                    <div class="col">
                        <div class="input-group input-group-flat">
                            <input type="text" class="form-control" wire:model.defer="questions.0" placeholder="{{ __('Enter or Paste your question here...') }}" required />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">{{ __('Answer') }} #1</label>
                    <div class="col">
                        <div class="input-group input-group-flat">
                            <input type="text" class="form-control" wire:model.defer="answers.0" placeholder="{{ __('Enter or Paste your answer here...') }}" required />
                        </div>
                    </div>
                </div>

                <button class="btn btn-sm btn-icon-only bg-success text-white rounded cursor-pointer position-absolute top-0 end-0 m-2" wire:click.prevent="onAddFAQ" title="{{ __('Add new') }}">
                    <i class="fas fa-plus"></i>
                </button>
            </div>

            @foreach($inputs as $key => $value)
                <div class="faq border p-3 rounded shadow-sm mb-3 position-relative" wire:key="faq-{{ $key }}">
                    <div class="form-group mb-3">
                        <label class="form-label">{{ __('Question') }} #{{ $value }}</label>
                        <div class="col">
                            <div class="input-group input-group-flat">
                                <input type="text" class="form-control" wire:model.defer="questions.{{ $value }}" placeholder="{{ __('Enter or Paste your question here...') }}" required />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('Answer') }} #{{ $value }}</label>
                        <div class="col">
                            <div class="input-group input-group-flat">
                                <input type="text" class="form-control" wire:model.defer="answers.{{ $value }}" placeholder="{{ __('Enter or Paste your answer here...') }}" required />
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-sm btn-icon-only bg-danger text-white rounded cursor-pointer position-absolute top-0 end-0 m-2" wire:click.prevent="onDeleteFAQ({{ $key }})" title="{{ __('Delete') }}" data-bs-original-title="{{ __('Delete') }}" data-bs-toggle="tooltip">
                      <i class="fas fa-trash"></i>
                    </button>
                </div>
            @endforeach
        </div>

        @if ($generalSettings->captcha_status && ($generalSettings->captcha_for_registered || !auth()->check()))
          <x-public.recaptcha />
        @endif

        <div class="form-group text-center mb-0">
            <button class="btn bg-gradient-info w-100 w-md-auto mb-1 mb-md-0" wire:loading.attr="disabled">
                <span>
                    <div wire:loading.inline wire:target="onFaqSchemaGenerator">
                        <x-loading />
                    </div>
                    <span wire:target="onFaqSchemaGenerator">{{ __('Generate') }}</span>
                </span>
            </button>

            <button class="btn bg-gradient-success w-100 w-md-auto mb-1 mb-md-0" wire:click.prevent="onSample" wire:loading.attr="disabled">
                <span>
                  <div wire:loading.inline wire:target="onSample">
                    <x-loading />
                  </div>
                    <span wire:target="onSample">{{ __('Sample') }}</span>
                </span>
            </button>

            <button class="btn bg-gradient-warning w-100 w-md-auto mb-0" wire:click.prevent="onReset" wire:loading.attr="disabled">
                <span>
                  <div wire:loading.inline wire:target="onReset">
                    <x-loading />
                  </div>
                    <span wire:target="onReset">{{ __('Reset') }}</span>
                </span>
            </button>
        </div>

        @if ( !empty($data) )
          <div class="form-group position-relative mt-3">
              <textarea id="text" class="form-control" rows="10">
<script type="application/ld+json">
{!! $data !!}
</script></textarea>
              <a value="copy" onclick="copyToClipboard()" class="btn btn-icon-only btn-success cursor-pointer position-absolute top-0 end-0 m-2" title="{{ __('Copy') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Copy') }}">
                  <i class="fas fa-copy"></i>
              </a>
          </div>
        @endif

      </form>

      <script>
          function copyToClipboard() {
            document.getElementById("text").select();
            document.execCommand('copy');
          }
      </script>
</div>