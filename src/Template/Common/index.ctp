<section class="content-header">
    <h1>Notes
        <small>
            <?= $this->Html->link(
                '<i class="fa fa-plus"></i>',
                ['plugin' => 'Notes', 'controller' => 'Notes', 'action' => 'add'],
                ['escape' => false]
            ); ?>
        </small>
    </h1>
</section>

<section class="content">
    <?php if (!empty($notes)) : ?>
        <?= $this->element('Notes.record_notes'); ?>
    <?php endif; ?>
    <div class="box box-solid">
        <div class="box-footer">
            <div class="paginator">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <?= $this->Paginator->prev('&laquo;', ['escape' => false]) ?>
                    <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
                    <?= $this->Paginator->next('&raquo;', ['escape' => false]) ?>
                </ul>
            </div>
        </div>
    </div>
</section>