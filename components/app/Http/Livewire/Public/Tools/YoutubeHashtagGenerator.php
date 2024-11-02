<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\YoutubeHashtagGeneratorClass;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class YoutubeHashtagGenerator extends Component
{
    protected $listeners = ['onSetInList', 'onClearInList'];
    public $query;
    public $lang = 'EN';
    public $data         = [];
    public $temp_data    = [];
    public $recaptcha;
    public $generalSettings;

    public function mount()
    {
        $this->generalSettings = General::first();
    }
    
    public function render()
    {
        return view('livewire.public.tools.youtube-hashtag-generator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onSetInList
     * -------------------------------------------------------------------------------
    **/
    public function onSetInList($value)
    {
        array_push($this->data, '#' . $value);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onClearInList
     * -------------------------------------------------------------------------------
    **/
    public function onClearInList()
    {
        $this->data = [];
    }

    /**
     * -------------------------------------------------------------------------------
     *  onYoutubeHashtagGenerator
     * -------------------------------------------------------------------------------
    **/
    public function onYoutubeHashtagGenerator(){

        $validationRules = [
            'query' => 'required'
        ];

        if ( $this->generalSettings->captcha_status && ($this->generalSettings->captcha_for_registered || !auth()->check()) ) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->temp_data = null;

        try {

                $output = new YoutubeHashtagGeneratorClass();

                $this->temp_data = $output->get_data( $this->query, $this->lang );

                $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->temp_data) ) {

            $history             = new History;
            $history->tool_name  = 'YouTube Hashtag Generator';
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
        $this->query = 'seo';
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->query     = null;
        $this->lang      = 'EN';
        $this->data      = [];
        $this->temp_data = [];
    }
}
