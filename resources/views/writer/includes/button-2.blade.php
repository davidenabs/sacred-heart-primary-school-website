<div class="card-footer text-right">
    <button wire:loading.attr="disabled" wire:target="{{ $method }}"
        class="btn btn-primary mr-1">
        <span wire:target="{{ $method }}" wire:loading.remove>{{ $title }}</span>
        <span wire:target="{{ $method }}" wire:loading>{{ $loadingState }}</span>
    </button>
    <button class="btn btn-secondary" type="reset">Reset</button>
</div>
