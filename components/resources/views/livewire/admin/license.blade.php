<!-- resources/views/livewire/admin/license.blade.php -->
<div>
    <form wire:submit.prevent="onUpdateLicense">
        <div class="form-group">
            <label for="purchase_code">{{ __('License Key') }}</label>
            <input type="text" class="form-control" id="purchase_code" wire:model="purchase_code" required>
            @error('purchase_code') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Update License') }}</button>
    </form>

    <button wire:click="onResetLicense" class="btn btn-danger mt-3">{{ __('Reset License') }}</button>

    @if (session()->has('message'))
        <div class="alert alert-success mt-3">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif
</div>