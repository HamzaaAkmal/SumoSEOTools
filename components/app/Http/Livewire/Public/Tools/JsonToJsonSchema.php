<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use App\Classes\JsonToJsonSchemaClass;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use App\Rules\VerifyRecaptcha;
use App\Models\Admin\General;

class JsonToJsonSchema extends Component
{

    public $data = [];
    public $json;
    public $recaptcha;
    public $generalSettings;

    public function mount()
    {
        $this->generalSettings = General::first();
    }
    
    public function render()
    {
        return view('livewire.public.tools.json-to-json-schema');
    }

    /**
     * -------------------------------------------------------------------------------
     *  onJsonToJsonSchema
     * -------------------------------------------------------------------------------
    **/
    public function onJsonToJsonSchema(){

        $validationRules = [
            'json' => 'required'
        ];

        if ( $this->generalSettings->captcha_status && ($this->generalSettings->captcha_for_registered || !auth()->check()) ) {
            $validationRules['recaptcha'] = ['required', new VerifyRecaptcha];
        }

        $this->validate($validationRules);

        $this->data = null;

        try {

            $output = new JsonToJsonSchemaClass();

            $this->data = $output->get_data( $this->json );

            $this->dispatchBrowserEvent('resetReCaptcha');

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'JSON to JSON Schema';
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
        $this->json = <<<EOT
{
    "name": "John Doe",
    "age": 30,
    "isStudent": false,
    "address": {
        "street": "123 Elm St",
        "city": "Springfield",
        "postalCode": "12345",
        "geo": {
            "lat": 34.0522,
            "lng": -118.2437
        }
    },
    "courses": [
        {
            "courseName": "Mathematics",
            "courseId": 101,
            "completed": true
        },
        {
            "courseName": "History",
            "courseId": 102,
            "completed": false
        }
    ],
    "email": "doe@example.com",
    "tags": ["friendly", "quick learner"]
}
EOT;
    }

    /**
     * -------------------------------------------------------------------------------
     *  onReset
     * -------------------------------------------------------------------------------
    **/
    public function onReset()
    {
         $this->json = null;
         $this->data = [];
    }
}
