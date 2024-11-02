<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class AdsenseCalculator extends Component
{

    public $impressions;
    public $ctr;
    public $cpc;
    public $data = [];
    public $recaptcha;
    public $generalSettings;

    public function mount()
    {
        $this->generalSettings = General::first();
    }
    
    public function render()
    {
        return view('livewire.public.tools.adsense-calculator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onAdsenseCalculator
     * -------------------------------------------------------------------------------
    **/
    public function onAdsenseCalculator(){

        $validationRules = [
            'impressions' => 'required',
            'ctr'         => 'required',
            'cpc'         => 'required'
        ];

        if ( $this->generalSettings->captcha_status && ($this->generalSettings->captcha_for_registered || !auth()->check()) ) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

                $daily_earnings                = $this->impressions * ($this->ctr / 100) * $this->cpc;
                $daily_clicks                  = $this->impressions * ($this->ctr / 100);

                $this->data['daily_earnings']  = $daily_earnings;
                $this->data['daily_clicks']    = $daily_clicks;

                $this->data['mothly_earnings'] = $daily_earnings * 30;
                $this->data['mothly_clicks']   = $daily_clicks *30;

                $this->data['yearly_earnings'] = $daily_earnings * 360;
                $this->data['yearly_clicks']   = $daily_clicks * 360;

                $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Adsense Calculator';
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

    /**
     * -------------------------------------------------------------------------------
     *  onSample
     * -------------------------------------------------------------------------------
    **/
    public function onSample()
    {
        $this->impressions = 1200;
        $this->ctr         = 12.5;
        $this->cpc         = 3.3;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->impressions = null;
        $this->ctr         = null;
        $this->cpc         = null;
        $this->data        = [];
    }
}
