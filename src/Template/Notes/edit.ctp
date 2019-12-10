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

echo $this->Html->scriptBlock(
    '$("#color-chooser > li > a").click(function (e) {
        e.preventDefault();
        // save color
        currColor = $(this).css("color");
        // add color effect to button
        $("#add-new-note").css({"background-color": currColor, "border-color": currColor});
        // save value
        currValue = $(this).data("value");
        // add value to "type" input
        $("[name=\'Notes[type]\']").val(currValue);
    });
    $("#shared-chooser > li > a").click(function (e) {
        e.preventDefault();
        // save icon
        currIcon = $(this).children("i").attr("class");
        // add icon to button
        $("#add-new-note").children("i").removeClass().addClass(currIcon);
        // save value
        currValue = $(this).data("value");
        // add value to "type" input
        $("[name=\'Notes[shared]\']").val(currValue);
    });',
    ['block' => 'scriptBottom']
);
?>
<section class="content-header">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <h4><?= __d('Qobo/Notes', 'Edit {0}', ['Note']) ?></h4>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">&nbsp;</h3>
                </div>
                <?= $this->Form->create($note); ?>
                <?= $this->Form->hidden('Notes.type'); ?>
                <?= $this->Form->hidden('Notes.shared'); ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
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
                        </div>
                        <div class="col-md-6">
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
                        </div>
                    </div>
                    <?= $this->Form->input('Notes.content', [
                        'type' => 'textarea',
                        'label' => false,
                        'required' => true,
                        'placeholder' => 'Message:'
                    ]); ?>
                </div>
                <div class="box-footer">
                    <?= $this->Form->button(
                        '<i class="fa fa-' . $shared[$note->shared]['icon'] . '"></i> ' . __d('Qobo/Notes', 'Submit'),
                        ['class' => 'btn btn-' . $note->type, 'id' => 'add-new-note']
                    ); ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</section>
