<?php

namespace App\Http\Livewire\Admin;

use App\Models\Install;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\Component;
use DateTime;

class License extends Component
{
    public $purchase_code;

    const VALID_LICENSE = 'SeeContent@1231@19@September';

    public function mount()
    {
        $this->purchase_code = Install::findOrFail(1)->first()->token;
    }

    public function render()
    {
        //Meta
        $title = __('License') . ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');
        SEOMeta::setTitle($title);

        return view('livewire.admin.license')->layout('layouts.admin', [
            'breadcrumbs' => [
                ['title' => __('Admin'), 'url' => route('admin.dashboard.index')],
                ['title' => __('License'), 'url' => null]
            ]
        ]);
    }

    public function onUpdateLicense()
    {
        try {
            if ($this->purchase_code === self::VALID_LICENSE) {
                $data = Install::findOrFail(1);
                $data->token = $this->purchase_code;
                $data->updated_at = new DateTime();
                $data->save();

                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('The license has been updated successfully!')]);
            } else {
                $this->addError('error', __('Invalid license key.'));
            }
        } catch (\Exception $e) {
            $this->addError('error', __($e->getMessage()));
        }
    }

    public function onResetLicense()
    {
        try {
            $data = Install::findOrFail(1);
            $data->token = null;
            $data->updated_at = new DateTime();
            $data->save();

            $this->purchase_code = null;
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('The license has been reset successfully!')]);
        } catch (\Exception $e) {
            $this->addError('error', __($e->getMessage()));
        }
    }
}