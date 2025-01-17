<?php

namespace App\Filament\Pages;

use App\Livewire\LatestPixPayments;
use App\Models\MaybankPayment;
use App\Models\User;
use App\Traits\Gateways\MaybankTrait;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Database\Eloquent\Model;

class MaybankPaymentPage extends Page
{
    use MaybankTrait;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static string $view = 'filament.pages.suit-pay-payment-page';

    protected static ?string $navigationLabel = 'Maybank Pagamentos';

    protected static ?string $modelLabel = 'Maybank Pagamentos';

    protected static ?string $title = 'Maybank Pagamentos';

    protected static ?string $slug = 'maybank-pagamentos';

    /**
     * @dev @victormsalatiel
     * @return bool
     */
    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('admin');
    }

    public ?array $data = [];
    public MaybankPayment $maybankPayment;

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->form->fill();
    }

    /**
     * @param Form $form
     * @return Form
     */
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detalhes de Pagamento')
                    ->schema([
                        Select::make('user_id')
                            ->label('Usuários')
                            ->placeholder('Selecione um usuário')
                            ->relationship(name: 'user', titleAttribute: 'name')
                            ->options(
                                fn($get) => User::query()
                                    ->pluck('name', 'id')
                            )
                            ->searchable()
                            ->preload()
                            ->live()
                            ->required(),
                        TextInput::make('pix_key')
                            ->label('Chave Pix')
                            ->placeholder('Digite a chave Pix')
                            ->required(),
                        Select::make('pix_type')
                            ->label('Tipo de Chave')
                            ->placeholder('Selecione o tipo de chave')
                            ->options([
                                'document' => 'Documento',
                                'phoneNumber' => 'Telefone',
                                'randomKey' => 'Chave aleatória',
                                'paymentCode' => 'Código de pagamento',
                            ]),
                        TextInput::make('amount')
                            ->label('Valor')
                            ->placeholder('Digite um valor')
                            ->required()
                            ->numeric(),
                        Textarea::make('observation')
                            ->label('Observação')
                            ->placeholder('Deixe uma observação caso tenha')
                            ->rows(5)
                            ->cols(10)
                            ->columnSpanFull()
                    ])->columns(2),
            ])
            ->statePath('data');
    }

    /**
     * @return void
     */
    public function submit(): void
    {
        if(env('APP_DEMO')) {
            Notification::make()
                ->title('Atenção')
                ->body('Você não pode realizar está alteração na versão demo')
                ->danger()
                ->send();
            return;
        }

        $maybankment = MaybankPayment::create([
            'user_id'       => $this->data['user_id'],
            'pix_key'       => $this->data['pix_key'],
            'pix_type'      => $this->data['pix_type'],
            'amount'        => $this->data['amount'],
            'observation'   => $this->data['observation'],
        ]);

        if($maybankment) {
            $resp = self::pixCashOut([
                'pix_key' => $this->data['pix_key'],
                'pix_type' => $this->data['pix_type'],
                'amount' => $this->data['amount'],
                'maybankment_id' => $maybankment->id
            ]);

            if($resp) {
                Notification::make()
                    ->title('Saque solicitado')
                    ->body('Saque solicitado com sucesso')
                    ->success()
                    ->send();
            }else{
                Notification::make()
                    ->title('Erro no saque')
                    ->body('Erro ao solicitar o saque')
                    ->danger()
                    ->send();
            }
        }else{
            Notification::make()
                ->title('Erro ao salvar')
                ->body('Erro ao salvar a requisição do saque')
                ->danger()
                ->send();
        }
    }

    /**
     * @return array|\Filament\Widgets\WidgetConfiguration[]|string[]
     */
    public function getFooterWidgets(): array
    {
        return [
            LatestPixPayments::class
        ];
    }
}
