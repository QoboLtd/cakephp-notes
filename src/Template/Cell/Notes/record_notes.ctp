<div class="row">
    <div class="col-xs-12">
        <div class="text-right add-new-note">
            <?= $this->Html->link(
                '<span class="fa fa-plus" aria-hidden="true"></span>',
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
                    <?php
                        $typeOptions = [];
                    foreach ($types as $value => $label) {
                        $typeOptions[] = [
                            'value' => $value,
                            'text' => '<span class="label label-' . $value . '">&nbsp;</span>'
                        ];
                    }
                    ?>
                    <div class="form-group note-colors">
                        <?= $this->Form->radio('type', $typeOptions, [
                                'escape' => false,
                                'label' => false,
                                'inline' => true,
                                'val' => 'info'
                        ]); ?>
                    </div>
                    <?php
                        $sharedOptions = [];
                        foreach ($shared as $value => $label) {
                            $sharedOptions[] = [
                                'value' => $value,
                                'text' => $label
                            ];
                        }
                    ?>
                    <div class="form-group">
                        <?= $this->Form->radio('shared', $sharedOptions, [
                                'escape' => false,
                                'inline' => true,
                                'val' => 'private'
                        ]); ?>
                    </div>
                    <?= $this->Form->input('content', ['type' => 'textarea', 'class' => 'input-sm', 'label' => false, 'placeholder' => 'note content']); ?>
                    <?php
                        $relatedModel = $this->request->param('controller');
                    if ($this->request->param('plugin')) {
                        $relatedModel = $this->request->param('plugin') . '.' . $relatedModel;
                    }
                    ?>
                    <?= $this->Form->hidden('related_model', ['value' => $relatedModel]); ?>
                    <?php if (isset($this->request->params['pass']) && !empty($this->request->params['pass'][0])) : ?>
                        <?= $this->Form->hidden('related_id', ['value' => $this->request->params['pass'][0]]); ?>
                    <?php endif; ?>
                </fieldset>
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary btn-sm']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($notes)) : ?>
    <?= $this->element('Notes.record_notes', [
        'notesView' => 'record'
    ]); ?>
<?php endif; ?>
