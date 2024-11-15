<?php

namespace App\View\Components\DataDisplay;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class DataTable extends Component
{
    public Collection $rows;
    public array $extraActions;
    public bool $showCreatedAt;
    public bool $showUpdatedAt;
    public array $columnsToIgnore; // Add this property to hold ignored columns

    /**
     * Create a new component instance.
     *
     * @param  mixed $rows
     * @param  array $extraActions
     * @param  bool $createAt
     * @param  bool $updatedAt
     * @param  array $columnsToIgnore
     * @return void
     */
    public function __construct($rows, array $extraActions = [], bool $createAt = false, bool $updatedAt = false, array $columnsToIgnore = [])
    {
        $this->rows = collect($rows); // Ensure rows are a collection for easier handling
        $this->extraActions = $extraActions;
        $this->showCreatedAt = $createAt;
        $this->showUpdatedAt = $updatedAt;
        $this->columnsToIgnore = $columnsToIgnore; // Assign ignored columns
    }

    /**
     * Get default and extra actions for a row.
     *
     * @param  Model $row
     * @return array
     */
    public function getActions(Model $row): array
    {
        $defaultActions = [
            'edit' => [
                'title' => 'Edit',
                'method' => 'GET',
                'icon' => 'ri-pencil-fill',
                'route' => route($row->getTable() . '.edit', $row->id),
            ],
            'delete' => [
                'title' => 'Delete',
                'method' => 'DELETE',
                'icon' => 'ri-delete-bin-fill',
                'route' => route($row->getTable() . '.destroy', $row->id),
            ],
            'show' => [
                'title' => 'Show',
                'method' => 'GET',
                'icon' => 'ri-eye-fill',
                'route' => route($row->getTable() . '.show', $row->id),
            ],
        ];

        $extraActions = array_map(function ($action) use ($row) {
            return [
                'title' => $action['title'],
                'method' => $action['method'],
                'icon' => $action['icon'],
                'route' => route($action['route'], $row->id),
            ];
        }, $this->extraActions);

        return array_merge($defaultActions, $extraActions);
    }

    /**
     * Filter visible columns for the table.
     *
     * @return array
     */
    public function getVisibleColumns(): array
    {
        if ($this->rows->isEmpty()) {
            return [];
        }
        $attributes = $this->rows->first()->getAttributes();
        return array_filter(array_keys($attributes), function ($column) {
            return !in_array($column, $this->columnsToIgnore) &&
                (!in_array($column, ['id', 'created_at', 'updated_at']) ||
                    ($this->showCreatedAt && $column === 'created_at') ||
                    ($this->showUpdatedAt && $column === 'updated_at'));
        });
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.data-display.data-table', [
            'columns' => $this->getVisibleColumns(),
        ]);
    }
}
