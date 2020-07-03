<?php
/**
 * Copyright (c) Qobo Ltd. (https://www.qobo.biz)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Qobo Ltd. (https://www.qobo.biz)
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
?>
<div class="box box-solid collapsed-box">
    <div class="box-header with-border" data-widget="collapse" style="cursor:pointer;">
        <i class="pull-right fa fa-plus"></i>
        <h3 class="box-title" style="font-size:initial;"><?= __d('Qobo/Notes', 'Create Note'); ?></h3>
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
                        <a class="text-<?= strtolower($v) ?>" href="#" data-value="<?= $k ?>">
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
                        <a class="text-black" href="#" data-value="<?= $k ?>" title="<?= $v['label'] ?>">
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
            'placeholder' => __d('Qobo/Notes', 'Message:')
        ]); ?>
    </div>
    <div class="box-footer">
        <div class="pull-right">
            <?= $this->Form->button('<i class="fa fa-eye-slash"></i> ' . __d('Qobo/Notes', 'Add'), [
                'class' => 'btn btn-primary',
                'id' => 'add-new-note'
            ]); ?>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>
