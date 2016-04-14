<div class="row">
    <div class="col-xs-12">
        <div class="text-right add-new-note">
            <?= $this->Html->link(
                '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>',
                '#collapseNotesForm',
                [
                    'title' => __('Add a new Note'),
                    'class' => 'btn btn-default',
                    'data-toggle' => 'collapse',
                    'escape' => false
                ]
            ); ?>
        </div>
        <div class="collapse" id="collapseNotesForm">
            <div class="well">
                <?= $this->Form->create(null, ['url' => [
                    'plugin' => 'Notes', 'controller' => 'Notes', 'action' => 'add'
                ]]); ?>
                <fieldset>
                    <?= $this->Form->input('type', ['options' => $types, 'empty' => '(choose type)', 'class' => 'input-sm', 'label' => false]); ?>
                    <?= $this->Form->input('shared', ['options' => $shared, 'empty' => '(choose visibility)', 'class' => 'input-sm', 'label' => false]); ?>
                    <?= $this->Form->input('title', ['class' => 'input-sm', 'label' => false, 'placeholder' => 'note title']); ?>
                    <?= $this->Form->input('content', ['type' => 'textarea', 'class' => 'input-sm', 'label' => false, 'placeholder' => 'note content']); ?>
                    <?= $this->Form->hidden('model', ['value' => $this->request->params['controller']]); ?>
                    <?php if (isset($this->request->params['pass']) && !empty($this->request->params['pass'][0])) : ?>
                        <?= $this->Form->hidden('primary_key', ['value' => $this->request->params['pass'][0]]); ?>
                    <?php endif; ?>
                </fieldset>
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary btn-sm']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($notes)) : ?>
    <?= $this->element('Notes.record_notes'); ?>
<?php endif; ?>