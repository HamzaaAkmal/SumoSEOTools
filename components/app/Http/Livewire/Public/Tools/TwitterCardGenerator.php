<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class TwitterCardGenerator extends Component
{

    public $title;
    public $site_username = '@';
    public $app_name;
    public $iphone_app_id;
    public $ipad_app_id;
    public $google_play_app_id;
    public $app_country;
    public $type          = 'app';
    public $description;

    public $data   = [];
    public $inputs = [];
    public $images = [];
    public $recaptcha;
    public $generalSettings;

    public function mount()
    {
        $this->generalSettings = General::first();
    }
    
    public function render()
    {
        return view('livewire.public.tools.twitter-card-generator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onAddImage
     * -------------------------------------------------------------------------------
    **/
    public function onAddImage()
    {
        $nextIndex = empty($this->inputs) ? 2 : end($this->inputs) + 1; 

        $this->inputs[$nextIndex] = $nextIndex;

    }

    /**
     * -------------------------------------------------------------------------------
     *  onDeleteImage
     * -------------------------------------------------------------------------------
    **/
    public function onDeleteImage($i)
    {
        unset($this->inputs[$i]);
        unset($this->images[$i]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onTwitterCardGenerator
     * -------------------------------------------------------------------------------
    **/
    public function onTwitterCardGenerator(){

        $validationRules = [];
        
        if ( $this->generalSettings->captcha_status && ($this->generalSettings->captcha_for_registered || !auth()->check()) ) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        if (!empty($validationRules)) {
            $this->validate($validationRules);
        }
        
        $this->data = null;

        try {

                $this->data .= ($this->type != "") ? '<meta name="twitter:card" content="' . $this->type . '">' . PHP_EOL : null;

                $this->data .= ($this->site_username != "") ? '<meta name="twitter:site" content="' . $this->site_username . '">' . PHP_EOL : null;

                $this->data .= ($this->description != "") ? '<meta name="twitter:description" content="' . $this->description . '">' . PHP_EOL : null;

                $this->data .= ($this->app_name != "") ? '<meta name="twitter:app:name:iphone" content="' . $this->app_name . '">' . PHP_EOL . '<meta name="twitter:app:name:ipad" content="' . $this->app_name . '">' . PHP_EOL . '<meta name="twitter:app:name:googleplay" content="' . $this->app_name . '">' . PHP_EOL : null;

                $this->data .= ($this->iphone_app_id != "") ? '<meta name="twitter:app:id:iphone" content="' . $this->iphone_app_id . '">' . PHP_EOL : null;

                $this->data .= ($this->ipad_app_id != "") ? '<meta name="twitter:app:id:ipad" content="' . $this->ipad_app_id . '">' . PHP_EOL : null;

                $this->data .= ($this->google_play_app_id != "") ? '<meta name="twitter:app:id:googleplay" content="' . $this->google_play_app_id . '">' . PHP_EOL : null;

                $this->data .= ($this->app_country != "") ? '<meta name="twitter:app:country" content="' . $this->app_country . '">' . PHP_EOL : null;

                if ( $this->images != null) {

                    foreach ($this->images as $key => $value) {

                        $this->data .= '<meta name="twitter:image" content="'.$value.'">' . PHP_EOL;
                    }

                }

                $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Twitter Card Generator';
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
