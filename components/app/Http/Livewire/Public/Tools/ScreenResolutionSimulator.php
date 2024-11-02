<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class ScreenResolutionSimulator extends Component
{
    public $link;
    public $data              = [];
    public $resolution        = '160x160';
    public $custom_resolution = '';
    public $recaptcha;
    public $generalSettings;

    public function mount()
    {
        $this->generalSettings = General::first();
    }
    
    public function render()
    {
        return view('livewire.public.tools.screen-resolution-simulator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onScreenResolutionSimulator
     * -------------------------------------------------------------------------------
    **/
    public function onScreenResolutionSimulator(){

        $validationRules = [
            'link' => 'required|url'
        ];

        if ( $this->generalSettings->captcha_status && ($this->generalSettings->captcha_for_registered || !auth()->check()) ) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        $resolution = ($this->resolution == 'custom') ? explode('x', $this->custom_resolution) : explode('x', $this->resolution);

        try {

                $this->dispatchBrowserEvent('onSetScreenResolution', ['link' => $this->link, 'resolution' => $this->resolution, 'width' => $resolution[0], 'height' => $resolution[1]]);

                $this->dispatchBrowserEvent('resetReCaptcha');
                
        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        $history             = new History;
        $history->tool_name  = 'Screen Resolution Simulator';
        $history->client_ip  = request()->ip();

        require app_path('Classes/geoip2.phar');

        $reader = new Reader( app_path('Classes/GeoLite2-City.mmdb') );

        try {

            $record           = $reader->city( request()->ip() );

            $history->flag    = strtolower( $record->country->isoCode );
            
            $history->country = strip_tags( $record->country->name );

        } catch (AddressNotFoundException $e) {

        }

        $history->created_at = new DateTime();
        $history->save();
    }

    /**
     * -------------------------------------------------------------------------------
     *  onSample
     * -------------------------------------------------------------------------------
    **/
    public function onSample()
    {
        $this->link = 'https://google.com';
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->link = null;
        $this->data    = [];
    }
}
