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
<section class="content-header">
    <h1>Notes
        <div class="pull-right">
            <div class="btn-group btn-group-sm" role="group">
            <?= $this->Html->link(
                '<i class="fa fa-plus"></i> ' . __('Add'),
                ['plugin' => 'Notes', 'controller' => 'Notes', 'action' => 'add'],
                ['escape' => false, 'title' => __('Add'), 'class' => 'btn btn-default']
            ); ?>
            </div>
        </div>
    </h1>
</section>

<section class="content">
<?php if (!$notes->isEmpty()) : ?>
    <div class="box box-primary">
        <div class="box-body">
            <?= $this->element('Notes.Notes/boxes'); ?>
        </div>
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
<?php endif; ?>
</section>
