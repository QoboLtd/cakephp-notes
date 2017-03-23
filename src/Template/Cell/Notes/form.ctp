<div class="box box-solid collapsed-box">
    <div class="box-header with-border">
        <h3 class="box-title"><?= __('Create Note'); ?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
    <?= $this->Form->create(null, ['url' => ['plugin' => 'Notes', 'controller' => 'Notes', 'action' => 'add']]); ?>
    <div class="box-body">
        <?php
        echo $this->Form->hidden('Notes.type', ['value' => key($types)]);
        echo $this->Form->hidden('Notes.shared', ['value' => key($shared)]);
        echo $this->Form->hidden('Notes.related_model', ['value' => $relatedModel]);
        echo $this->Form->hidden('Notes.related_id', ['value' => $relatedId]);
        ?>
        <div class="form-group">
            <div class="btn-group">
                <ul class="fc-color-picker" id="color-chooser">
                <?php foreach ($types as $k => $v) : ?>
                    <li>
                        <a class="text-<?= strtolower($v); ?>" href="#" data-value="<?= $k; ?>">
                            <i class="fa fa-square"></i>
                        </a>
                    </li>
                <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="form-group">
            <div class="btn-group">
                <ul class="fc-color-picker" id="shared-chooser">
                <?php foreach ($shared as $k => $v) : ?>
                    <li>
                        <a class="text-black" href="#" data-value="<?= $k; ?>">
                            <i class="fa fa-<?= $v['icon']; ?>"></i>
                        </a>
                    </li>
                <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?= $this->Form->input('Notes.content', [
            'type' => 'textarea',
            'class' => 'input-sm',
            'label' => false,
            'required' => true,
            'placeholder' => 'Message:'
        ]); ?>
    </div>
    <div class="box-footer">
        <div class="pull-right">
            <?= $this->Form->button('<i class="fa fa-eye-slash"></i> ' . __('Add'), [
                'class' => 'btn btn-primary',
                'id' => 'add-new-note'
            ]); ?>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>