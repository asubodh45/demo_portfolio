<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-briefcase';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Basic Info')->components([
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug($state))),
                TextInput::make('slug')->required()->unique(ignoreRecord: true),
                TextInput::make('tagline')->maxLength(255),
                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
            ])->columns(2),

            Section::make('Case Study')->components([
                Textarea::make('overview')->rows(3)->label('Overview')->columnSpanFull(),
                Textarea::make('problem')->rows(3)->label('Challenge')->columnSpanFull(),
                Textarea::make('approach')->rows(3)->label('Approach')->columnSpanFull(),
                Textarea::make('solution')->rows(3)->label('Solution')->columnSpanFull(),
                Textarea::make('outcome')->rows(3)->label('Outcome')->columnSpanFull(),
            ]),

            Section::make('Details')->components([
                TextInput::make('client'),
                TextInput::make('year'),
                TagsInput::make('tags')->placeholder('Add tag'),
                FileUpload::make('cover_image')->image()->directory('projects'),
            ])->columns(2),

            Section::make('Gallery')->components([
                Repeater::make('images')
                    ->relationship()
                    ->schema([
                        FileUpload::make('url')->image()->directory('projects')->required(),
                        TextInput::make('alt')->label('Alt text'),
                        TextInput::make('sort_order')->numeric()->default(0),
                    ])
                    ->columns(3)
                    ->collapsed(),
            ]),

            Section::make('Visibility')->components([
                Toggle::make('featured')->default(false),
                Toggle::make('published')->default(true),
                TextInput::make('sort_order')->numeric()->default(0),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover_image')->square(),
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('category.name')->badge(),
                TextColumn::make('year'),
                IconColumn::make('featured')->boolean(),
                IconColumn::make('published')->boolean(),
                TextColumn::make('sort_order')->sortable(),
            ])
            ->filters([
                SelectFilter::make('category')->relationship('category', 'name'),
                TernaryFilter::make('featured'),
                TernaryFilter::make('published'),
            ])
            ->recordActions([EditAction::make(), DeleteAction::make()])
            ->defaultSort('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
