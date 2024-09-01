<?php

class SelectEditCharityState extends BaseSelectState
{
    public function __construct()
    {
        $this->tableHeader = ['OPTION', 'ID', 'Name', 'Email'];
        $this->backState = new ViewCharityState();
        $this->actionText = "charity information you want to edit";
    }

    protected function getData(): array
    {
        return Charity::getAll();
    }

    protected function createOptions(mixed $data): void
    {
        $this->options["Edit Charity ID " . $data->id] = new EditCharityState($data->id);
    }

    protected function mapItemToTableRow(mixed $item, int $index): array
    {
        return ["[$index]", $item->id, $item->name, $item->email];
    }
}

