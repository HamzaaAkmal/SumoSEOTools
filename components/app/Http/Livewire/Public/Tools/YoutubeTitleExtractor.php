<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\YoutubeTitleExtractorClass;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class YoutubeTitleExtractor extends Component
{

    protected $listeners = ['onSetInList', 'onClearInList'];
    public $link;
    public $data = [];
    public $recaptcha;
    public $generalSettings;

    public function mount()
    {
        $this->generalSettings = General::first();
    }
    
    public function render()
    {
        return view('livewire.public.tools.youtube-title-extractor');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onSetInList
     * -------------------------------------------------------------------------------
    **/
    public function onSetInList($value)
    {
        array_push($this->data, $value);
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
     *  onYoutubeTitleExtractor
     * -------------------------------------------------------------------------------
    **/
    public function onYoutubeTitleExtractor(){

        $validationRules = [
            'link' => 'required'
        ];

        if ( $this->generalSettings->captcha_status && ($this->generalSettings->captcha_for_registered || !auth()->check()) ) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

                $output = new YoutubeTitleExtractorClass();

                $this->data = $output->get_data( $this->link );

                $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'YouTube Title Extractor';
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
        $this->link = 'https://www.youtube.com/watch?v=K4DyBUG242c';
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->link = null;
        $this->data = [];
    }
}
