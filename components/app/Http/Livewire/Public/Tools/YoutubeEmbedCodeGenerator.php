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

class YoutubeEmbedCodeGenerator extends Component
{

    public $link;
    public $size_width = '560';
    public $size_height = '315';
    public $start_min;
    public $start_sec;
    public $end_min;
    public $end_sec;
    public $loop_video;
    public $auto_play_video;
    public $hide_full_screen_button;
    public $hide_player_controls;
    public $hide_youtube_logo;
    public $no_cookie;
    public $responsive;

    public $data = [];
    public $recaptcha;
    public $generalSettings;

    public function mount()
    {
        $this->generalSettings = General::first();
    }
    
    public function render()
    {
        return view('livewire.public.tools.youtube-embed-code-generator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onYoutubeEmbedCodeGenerator
     * -------------------------------------------------------------------------------
    **/
    public function onYoutubeEmbedCodeGenerator(){

        $validationRules = [
            'link' => 'required'
        ];

        if ( $this->generalSettings->captcha_status && ($this->generalSettings->captcha_for_registered || !auth()->check()) ) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

                $check = preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[\w\-?&!#=,;]+/[\w\-?&!#=/,;]+/|(?:v|e(?:mbed)?)/|[\w\-?&!#=,;]*[?&]v=)|youtu\.be/)([\w-]{11})(?:[^\w-]|\Z)%i', $this->link, $videoId);

                if ( $check ) {

                    $info = array(
                        'start'          => ( ( !empty($this->start_min) ? $this->start_min * 60 : 0 ) + ( !empty($this->start_sec) ? $this->start_sec : 0 ) ) ?: null,
                        'end'            => ( ( !empty($this->end_min) ? $this->end_min * 60 : 0 ) + ( !empty($this->end_sec) ? $this->end_sec : 0 ) ) ?: null,
                        'loop'           => ( $this->loop_video ) ?: $this->loop_video,
                        'autoplay'       => ( $this->auto_play_video ) ?: $this->auto_play_video,
                        'fs'             => ( $this->hide_full_screen_button ) ? 0 : null,
                        'controls'       => ( $this->hide_player_controls ) ? 0 : null,
                        'modestbranding' => ( $this->hide_youtube_logo ) ?: $this->hide_youtube_logo,
                    );

                    $query = http_build_query( array_filter($info, 'strlen') );

                    $embed_link = ( $this->no_cookie == true) ? 'https://www.youtube-nocookie.com/embed/' . $videoId[1] : 'https://www.youtube.com/embed/' . $videoId[1];

                    $embed_link .= ($query) ? '?' : '';

                    if ($this->responsive) {
                        
                        $this->data = '<div style="position:relative;height:0;overflow:hidden;padding-bottom:56.25%;border-style:none"><iframe style="position:absolute;top:0;left:0;width:100%;height:100%" src="'.$embed_link . $query.'"></iframe></div>';
                          
                    }
                    else $this->data = '<iframe width="'.$this->size_width.'" height="'.$this->size_height.'" src="'.$embed_link . $query.'"></iframe>';

                } else {

                    session()->flash('status', 'error');
                    session()->flash('message', __('Invalid Video URL!'));
                    return;
                }

                $this->dispatchBrowserEvent('resetReCaptcha');


        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'YouTube Embed Code Generator';
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
        $this->link                    = 'https://www.youtube.com/watch?v=K4DyBUG242c';
        $this->loop_video              = true;
        $this->hide_full_screen_button = true;
        $this->hide_player_controls    = true;
        $this->hide_youtube_logo       = true;
        $this->responsive              = true;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
        $this->link                    = null;
        $this->size_width              = '560';
        $this->size_height             = '315';
        $this->start_min               = null;
        $this->start_sec               = null;
        $this->end_min                 = null;
        $this->end_sec                 = null;
        $this->loop_video              = null;
        $this->auto_play_video         = null;
        $this->hide_full_screen_button = null;
        $this->hide_player_controls    = null;
        $this->hide_youtube_logo       = null;
        $this->no_cookie               = null;
        $this->responsive              = null;
        $this->data                    = [];
    }
}
