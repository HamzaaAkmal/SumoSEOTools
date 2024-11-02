<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use App\Classes\FaqSchemaGeneratorClass;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class FaqSchemaGenerator extends Component
{

    public $data      = [];
    public $inputs    = [];
    public $questions = [];
    public $answers   = [];
    public $recaptcha;
    public $generalSettings;

    public function mount()
    {
        $this->generalSettings = General::first();
    }
    
    public function render()
    {
        return view('livewire.public.tools.faq-schema-generator');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onAddFAQ
     * -------------------------------------------------------------------------------
    **/
    public function onAddFAQ()
    {
        $nextIndex = empty($this->inputs) ? 2 : end($this->inputs) + 1; 
        $this->inputs[$nextIndex] = $nextIndex;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onDeleteFAQ
     * -------------------------------------------------------------------------------
    **/
    public function onDeleteFAQ($indexToDelete)
    {
        unset($this->inputs[$indexToDelete]);
        unset($this->questions[$indexToDelete]);
        unset($this->answers[$indexToDelete]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onFaqSchemaGenerator
     * -------------------------------------------------------------------------------
    **/
    public function onFaqSchemaGenerator(){

        $validationRules = [
            'questions' => 'required',
            'answers' => 'required'
        ];

        if ( $this->generalSettings->captcha_status && ($this->generalSettings->captcha_for_registered || !auth()->check()) ) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new FaqSchemaGeneratorClass();

            $this->data = $output->get_data( $this->questions, $this->answers);

            $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'FAQ Schema Generator';
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
        $this->questions[0] = 'What is Lorem Ipsum?';
        $this->answers[0]   = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.';
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
         $this->questions[0] = null;
         $this->answers[0]   = null;
         $this->inputs       = [];
         $this->questions    = [];
         $this->answers      = [];
         $this->data         = [];
    }
}
