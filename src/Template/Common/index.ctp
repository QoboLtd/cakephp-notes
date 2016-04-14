<div class="row">
    <div class="col-xs-12">
        <p class="text-right">
            <?= $this->Html->link(__('Add Note'), ['action' => 'add'], ['class' => 'btn btn-primary']); ?>
        </p>
    </div>
</div>

<?php if (!empty($notes)) : ?>
    <?= $this->element('Notes.record_notes', [
        'rowItems' => 6
    ]); ?>
<?php endif; ?>

<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>