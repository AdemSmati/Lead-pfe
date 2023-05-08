<div style="display:flex; height: 80vh;width: 80%;">
    <div>
        @includeIf($beforeStatusBoardView)
    </div>
    <div class="{{ $styles['wrapper'] }}">
        @foreach($statuses as $status)
            @include($statusView, [
              'status' => $status
            ])
        @endforeach
    </div>

    <div>
        @includeIf($afterStatusBoardView)
    </div>
    <div wire:ignore>
        @includeWhen($sortable, 'livewire-status-board::sortable', [
          'sortable' => $sortable,
          'sortableBetweenStatuses' => $sortableBetweenStatuses,
        ])
    </div>
</div>
<style>
    .wrapper {
        width: calc(100% - 250px);
        margin-right: 250px;
    }
</style>
