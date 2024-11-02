<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use App\Classes\YoutubeChannelSearchClass;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class YoutubeChannelSearch extends Component
{

    public $query;
    public $country = 'US';
    public $result  = 6;
    public $data    = [];
    public $recaptcha;
    public $generalSettings;

    public function mount()
    {
        $this->generalSettings = General::first();
    }
    
    public function render()
    {
        return view('livewire.public.tools.youtube-channel-search');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onYoutubeChannelSearch
     * -------------------------------------------------------------------------------
    **/
    public function onYoutubeChannelSearch(){

        $validationRules = [
            'query'   => 'required',
            'country' => 'required',
            'result'  => 'required|numeric|min:1|max:100'
        ];

        if ( $this->generalSettings->captcha_status && ($this->generalSettings->captcha_for_registered || !auth()->check()) ) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

                $output = new YoutubeChannelSearchClass();

                $this->data = $output->get_data( $this->query, $this->country, $this->result );

                $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'YouTube Channel Search';
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
        $this->query   = 'seo';
        $this->country = 'US';
        $this->result  = 6;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->query   = null;
        $this->country = 'US';
        $this->result  = 6;
        $this->data    = [];
    }
}
