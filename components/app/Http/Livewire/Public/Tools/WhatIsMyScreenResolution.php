<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class WhatIsMyScreenResolution extends Component
{
    public $data = [];
    public $recaptcha;
    public $generalSettings;
    protected $listeners = ['onWhatIsMyScreenResolution'];

    public function mount()
    {
        $this->generalSettings = General::first();
    }
    
    public function render()
    {
        return view('livewire.public.tools.what-is-my-screen-resolution');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onSetScreenResolution
     * -------------------------------------------------------------------------------
    **/
    public function onSetScreenResolution(){
        $this->dispatchBrowserEvent('onSetScreenResolution');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onWhatIsMyScreenResolution
     * -------------------------------------------------------------------------------
    **/
    public function onWhatIsMyScreenResolution($width, $height, $dpr, $color, $viewport_width, $viewport_height){

        $validationRules = [];
        
        if ( $this->generalSettings->captcha_status && ($this->generalSettings->captcha_for_registered || !auth()->check()) ) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        if (!empty($validationRules)) {
            $this->validate($validationRules);
        }
        
        $this->data = null;

        try {

                $this->data['width']  = $width;
                $this->data['height'] = $height;
                $this->data['dpr'] = $dpr;
                $this->data['color'] = $color;
                $this->data['viewport_width'] = $viewport_width;
                $this->data['viewport_height'] = $viewport_height;

                $this->dispatchBrowserEvent('resetReCaptcha');
            
        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'What Is My Screen Resolution';
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
    }
    //
}
