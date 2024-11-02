<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\UrlOpenerClass;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;
use App\Rules\DomainNameValidation;

class UrlOpener extends Component
{

    public $links;
    public $recaptcha;
    public $generalSettings;

    public function mount()
    {
        $this->generalSettings = General::first();
    }
    
    public function render()
    {
        return view('livewire.public.tools.url-opener');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onUrlOpener
     * -------------------------------------------------------------------------------
    **/
    public function onUrlOpener(){

        $validationRules = [
            'links' => 'required'
        ];

        if ( $this->generalSettings->captcha_status && ($this->generalSettings->captcha_for_registered || !auth()->check()) ) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        try {

                $data = array();

                $links = explode(chr(10), $this->links);

                foreach ($links as $value) {
                    array_push( $data, $value );
                }
                
                $this->dispatchBrowserEvent('onSetUrlOpener', ['links' => $data]);

                $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        $history             = new History;
        $history->tool_name  = 'URL Opener';
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
    $this->links = <<<EOT
https://google.com
https://facebook.com
https://twitter.com
EOT;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->links = null;
        $this->data    = [];
    }
}
