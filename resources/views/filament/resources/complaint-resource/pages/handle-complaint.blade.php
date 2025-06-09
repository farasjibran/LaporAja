<x-filament-panels::page>
    <x-filament::card>
        <div class="space-y-4">
            <h2 class="text-xl font-bold">Complaint Details</h2>

            <div>
                <h3 class="font-semibold">Title</h3>
                <p>{{ $this->record->title_complaint }}</p>
            </div>

            <div>
                <h3 class="font-semibold">Description</h3>
                <p>{{ $this->record->description }}</p>
            </div>

            @if ($this->record->attachment)
                <div>
                    <h3 class="font-semibold">Original Attachment</h3>
                    <a href="{{ Storage::temporaryUrl($this->record->attachment, now()->addMinutes(5)) }}" target="_blank"
                        class="text-primary-600 hover:underline">
                        View Attachment
                    </a>
                </div>
            @endif
        </div>
    </x-filament::card>

    <form wire:submit="submitResponse">
        {{ $this->form }}
    </form>

</x-filament-panels::page>
