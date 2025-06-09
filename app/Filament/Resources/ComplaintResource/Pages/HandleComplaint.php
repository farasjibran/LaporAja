<?php

namespace App\Filament\Resources\ComplaintResource\Pages;

use App\Filament\Resources\ComplaintResource;
use App\Models\Complaints;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;

class HandleComplaint extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = ComplaintResource::class;

    protected static string $view = 'filament.resources.complaint-resource.pages.handle-complaint';

    public ?array $data = [];

    public Complaints $record;

    public function mount(Complaints $record): void
    {
        $this->record = $record;
        $this->form->fill([
            'status' => $this->record->status,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('status')
                    ->label('Update Complaint Status')
                    ->options([
                        'in_progress' => 'In Progress',
                        'closed' => 'Closed',
                        'rejected' => 'Rejected',
                    ])
                    ->required()
                    ->live(),

                Textarea::make('response_message')
                    ->label('Your Response')
                    ->rows(5)
                    ->required(fn(Get $get): bool => in_array($get('status'), ['closed', 'rejected'])),

                FileUpload::make('response_attachment')
                    ->label('Supporting Document for Response')
                    ->disk('public')
                    ->directory('complaint-responses')
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(2048)
                    ->helperText('Only PDF files are allowed (2MB Max)')
                    ->required(fn(Get $get): bool => in_array($get('status'), ['closed', 'rejected'])),
            ])
            ->statePath('data')
            ->model($this->record);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('submitResponse')
                ->label('Submit Response')
                ->action('submitResponse'),
        ];
    }

    public function submitResponse(): void
    {
        $data = $this->form->getState();

        $this->record->update([
            'status' => $data['status'],
            'complaint_response' => $data['response_message'],
            'supporting_documents_response' => $data['response_attachment'],
        ]);

        Notification::make()
            ->title('Complaint updated successfully')
            ->success()
            ->send();

        $this->redirect($this->getResource()::getUrl('index'));
    }
}
