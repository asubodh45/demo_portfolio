<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProcessStepResource\Pages;
use App\Models\ProcessStep;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProcessStepResource extends Resource
{
    protected static ?string $model = ProcessStep::class;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-numbered-list';
    protected static ?string $navigationLabel = 'Process Steps';
    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()->components([
                TextInput::make('step_number')->numeric()->required(),
                TextInput::make('sort_order')->numeric()->default(0),
                TextInput::make('title')->required()->columnSpanFull(),
                Textarea::make('description')->rows(3)->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('step_number')->sortable(),
                TextColumn::make('title')->searchable(),
                TextColumn::make('description')->limit(60),
            ])
            ->recordActions([EditAction::make(), DeleteAction::make()])
            ->defaultSort('step_number');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProcessSteps::route('/'),
            'create' => Pages\CreateProcessStep::route('/create'),
            'edit' => Pages\EditProcessStep::route('/{record}/edit'),
        ];
    }
}
