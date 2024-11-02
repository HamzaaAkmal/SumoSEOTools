<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use DateTime;
use Artesaos\SEOTools\Facades\SEOMeta;
use Brotzka\DotenvEditor\DotenvEditor;
use App\Models\Admin\General;

class Captcha extends Component
{
    public $captcha_status;
    public $captcha_for_registered;
    public $site_key;
    public $secret_key;

    public function mount()
    {
        $general                      = General::findOrFail(1);
        $this->captcha_status         = $general->captcha_status;
        $this->captcha_for_registered = $general->captcha_for_registered;
        $this->site_key               = env("GOOGLE_RECAPTCHA_SITE_KEY");
        $this->secret_key             = env("GOOGLE_RECAPTCHA_SECRET_KEY");
    }

    public function render()
    {

        //Meta
        $title = __('Captcha') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.settings.captcha')->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __( 'Admin' ), 'url' => route('admin.dashboard.index')],
                ['title' => __( 'Captcha' ), 'url' => null]
            ]
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onUpdateCaptcha
     * -------------------------------------------------------------------------------
    **/
    public function onUpdateCaptcha()
    {
        try {

            $env = new DotenvEditor();

            $env->changeEnv([
                'GOOGLE_RECAPTCHA_SITE_KEY'   => "'$this->site_key'",
                'GOOGLE_RECAPTCHA_SECRET_KEY' =>  "'$this->secret_key'"
            ]);

            $general                         = General::findOrFail(1);
            $general->captcha_status         = $this->captcha_status;
            $general->captcha_for_registered = $this->captcha_for_registered;
            $general->updated_at             = new DateTime();
            $general->save();
            
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }
    }
}
