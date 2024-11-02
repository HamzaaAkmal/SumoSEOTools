<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class OpenGraphGenerator extends Component
{

    public $title;
    public $site_name;
    public $site_url;
    public $type = 'website';
    public $description;

    public $data   = [];
    public $inputs = [];
    public $images = [];
    public $i      = 1;
    public $recaptcha;
    public $generalSettings;

    public function mount()
    {
        $this->generalSettings = General::first();
    }
    
    public function render()
    {
        return view('livewire.public.tools.open-graph-generator');
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
     *  onOpenGraphGenerator
     * -------------------------------------------------------------------------------
    **/
    public function onOpenGraphGenerator(){

        $validationRules = [];
        
        if ( $this->generalSettings->captcha_status && ($this->generalSettings->captcha_for_registered || !auth()->check()) ) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        if (!empty($validationRules)) {
            $this->validate($validationRules);
        }
        
        $this->data = null;

        try {

                $this->data .= ($this->title != "") ? '<meta property="og:title" content="' . $this->title . '">' . PHP_EOL : null;

                $this->data .= ($this->site_name != "") ? '<meta property="og:site_name" content="' . $this->site_name . '">' . PHP_EOL : null;

                $this->data .= ($this->site_url != "") ? '<meta property="og:url" content="' . $this->site_url . '">' . PHP_EOL : null;

                $this->data .= ($this->description != "") ? '<meta property="og:description" content="' . $this->description . '">' . PHP_EOL : null;

                $this->data .= ($this->type != "") ? '<meta property="og:type" content="' . $this->type . '">' . PHP_EOL : null;

                if ( $this->images != null) {

                    foreach ($this->images as $key => $value) {

                        $this->data .= '<meta property="og:image" content="'.$value.'">' . PHP_EOL;
                    }

                }

                $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Open Graph Generator';
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
