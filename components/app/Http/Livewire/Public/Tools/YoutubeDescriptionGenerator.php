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

class YoutubeDescriptionGenerator extends Component
{

    protected $listeners = ['onSetInList', 'onClearInList'];
    public $about_the_video;
    public $about_the_video_status = true;

    public $timestamps;
    public $timestamps_status = true;

    public $about_the_channel;
    public $about_the_channel_status = true;

    public $recommended;
    public $recommended_status = true;

    public $about_our_products;
    public $about_our_products_status = true;

    public $our_website;
    public $our_website_status = true;

    public $contact;
    public $contact_status = true;

    public $data = [];
    public $recaptcha;
    public $generalSettings;

    public function mount()
    {
        $this->generalSettings    = General::first();
        
        $this->about_the_video    = __('Hi, thanks for watching our video about {your video}!\nIn this video, we\'ll walk you through:\n- {Topic 1}\n- {Topic 2}\n- {Topic 3}');
        $this->about_the_video    = str_replace('\n', "\n", $this->about_the_video);

        $this->timestamps         = __('TIMESTAMPS\n0:00 Intro\n1:00 First Topic Covered\n1:30 Second Topic Covered\n2:30 Third Topic Covered');
        $this->timestamps         = str_replace('\n', "\n", $this->timestamps);
        
        $this->about_the_channel  = __('ABOUT OUR CHANNEL\nOur channel is about {topic}. We cover lots of cool stuff such as {topic}, {topic} and {topic}\nCheck out our channel here:\nhttps://www.youtube.com/channel\nDon\'t forget to subscribe!');
        $this->about_the_channel  = str_replace('\n', "\n", $this->about_the_channel);

        $this->recommended        = __('CHECK OUT OUR OTHER VIDEOS\nhttps://www.youtube.com/watch?v=video1\nhttps://www.youtube.com/watch?v=video2\nhttps://www.youtube.com/watch?v=video3');
        $this->recommended        = str_replace('\n', "\n", $this->recommended);
        
        $this->about_our_products = __('We sell these excellent products. Check them out here:\nhttps://www.website.com/product1\nhttps://www.website.com/product2\nhttps://www.website.com/product3');
        $this->about_our_products = str_replace('\n', "\n", $this->about_our_products);
        
        $this->our_website        = __('FIND US AT\nhttps://www.website.com/');
        $this->our_website        = str_replace('\n', "\n", $this->our_website);

        $this->contact            = __('GET IN TOUCH\nContact us at info@company.com\n\nFOLLOW US ON SOCIAL\nGet updates or reach out to Get updates on our Social Media Profiles!\nTwitter: https://twitter.com/{profile}\nFacebook: https://facebook.com/{profile}\nInstagram: https://twitter.com/{profile}\nSpotify: https://spotify.com/{profile}');
        $this->contact            = str_replace('\n', "\n", $this->contact);
    }

    public function render()
    {
        return view('livewire.public.tools.youtube-description-generator');
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
     *  onYoutubeDescriptionGenerator
     * -------------------------------------------------------------------------------
    **/
    public function onYoutubeDescriptionGenerator(){

        $validationRules = [];
        
        if ( $this->generalSettings->captcha_status && ($this->generalSettings->captcha_for_registered || !auth()->check()) ) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        if (!empty($validationRules)) {
            $this->validate($validationRules);
        }
        
        $this->data = null;

        try {

                $this->data .= ( $this->about_the_video_status == true ) ? $this->about_the_video . PHP_EOL . PHP_EOL : '';

                $this->data .= ( $this->timestamps_status == true ) ? $this->timestamps . PHP_EOL . PHP_EOL : '';

                $this->data .= ( $this->about_the_channel_status == true ) ? $this->about_the_channel . PHP_EOL . PHP_EOL : '';

                $this->data .= ( $this->recommended_status == true ) ? $this->recommended . PHP_EOL . PHP_EOL : '';

                $this->data .= ( $this->about_our_products_status == true ) ? $this->about_our_products . PHP_EOL . PHP_EOL : '';

                $this->data .= ( $this->our_website_status == true ) ? $this->our_website . PHP_EOL . PHP_EOL : '';

                $this->data .= ( $this->contact_status == true ) ? $this->contact : '';

                $this->data = rtrim($this->data);

                $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'YouTube Description Generator';
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
