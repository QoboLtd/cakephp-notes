<div class="row">
    <div class="col-xs-12">
        <h3><strong><?= $this->Html->link(__('Notes'), ['action' => 'index']) . ' &raquo; ' . h($note->title) ?></strong></h3>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">&nbsp;</h3>
            </div>
            <table class="table table-hover">
                <tr>
                    <td class="col-xs-3 text-right">
                        <strong><?= __('Id') ?>:</strong>
                    </td>
                    <td class="col-xs-3"><?= h($note->id) ?></td>
                    <td class="col-xs-3 text-right">
                        <strong><?= __('User') ?>:</strong>
                    </td>
                    <td class="col-xs-3"><?= $note->has('user') ? $this->Html->link($note->user->username, ['controller' => 'Users', 'action' => 'view', $note->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <td class="col-xs-3 text-right">
                        <strong><?= __('Type') ?>:</strong>
                    </td>
                    <td class="col-xs-3"><?= h($types[$note->type]) ?></td>
                    <td class="col-xs-3 text-right">
                        <strong><?= __('Shared') ?>:</strong>
                    </td>
                    <td class="col-xs-3"><?= h($shared[$note->shared]) ?></td>
                </tr>
                <tr>
                    <td class="col-xs-3 text-right">
                        <strong><?= __('Title') ?>:</strong>
                    </td>
                    <td class="col-xs-3"><?= h($note->title) ?></td>
                    <td class="col-xs-3 text-right">
                        <strong><?= __('Content') ?>:</strong>
                    </td>
                    <td class="col-xs-3"><?= $this->Text->autoParagraph(h($note->content)); ?></td>
                </tr>
                <tr>
                    <td class="col-xs-3 text-right">
                        <strong><?= __('Model') ?>:</strong>
                    </td>
                    <td class="col-xs-3"><?= h($note->model) ?></td>
                    <td class="col-xs-3 text-right">
                        <strong><?= __('Primary Key') ?>:</strong>
                    </td>
                    <td class="col-xs-3"><?= h($note->primary_key) ?></td>
                </tr>
                <tr>
                    <td class="col-xs-3 text-right">
                        <strong><?= __('Created') ?>:</strong>
                    </td>
                    <td class="col-xs-3"><?= h($note->created) ?></td>
                    <td class="col-xs-3 text-right">
                        <strong><?= __('Modified') ?>:</strong>
                    </td>
                    <td class="col-xs-3"><?= h($note->modified); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
