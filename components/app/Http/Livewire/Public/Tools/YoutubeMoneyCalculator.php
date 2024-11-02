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

class YoutubeMoneyCalculator extends Component
{
    protected $listeners = ['onSetViews', 'onSetMin', 'onSetMax'];
    public $views;
    public $cpm_min = 0.25;
    public $cpm_max = 4;

    public $data = [];
    public $recaptcha;
    public $generalSettings;

    public function mount()
    {
        $this->generalSettings = General::first();
    }
    
    public function render()
    {
        return view('livewire.public.tools.youtube-money-calculator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onSetViews
     * -------------------------------------------------------------------------------
    **/
    public function onSetViews($value)
    {
        $this->views= $value;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onSetMin
     * -------------------------------------------------------------------------------
    **/
    public function onSetMin($value)
    {
        $this->cpm_min = $value;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onSetMax
     * -------------------------------------------------------------------------------
    **/
    public function onSetMax($value)
    {
        $this->cpm_max = $value;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onYoutubeMoneyCalculator
     * -------------------------------------------------------------------------------
    **/
    public function onYoutubeMoneyCalculator(){

        $validationRules = [
            'views'   => 'required',
            'cpm_min' => 'required',
            'cpm_min' => 'required'
        ];

        if ( $this->generalSettings->captcha_status && ($this->generalSettings->captcha_for_registered || !auth()->check()) ) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

                $earnings_min = ( intval($this->views) / 1000) * $this->cpm_min;
                $earnings_max = ( intval($this->views) / 1000) * $this->cpm_max;

                $this->data['cpm_min'] = number_format( $earnings_min, 2);
                $this->data['cpm_max'] = number_format( $earnings_max, 2);

                $this->data['cpm_min_monthly'] = number_format( $earnings_min * 30, 2);
                $this->data['cpm_max_monthly'] = number_format( $earnings_max * 30, 2);

                $this->data['cpm_min_yearly'] = number_format( $earnings_min * 30 * 12, 2);
                $this->data['cpm_max_yearly'] = number_format( $earnings_max * 30 * 12, 2);

                $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'YouTube Money Calculator';
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
}
