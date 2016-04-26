<?= $this->Html->css('Notes.notes'); ?>

<?php
/*
set lg width
 */
$lgColWidth = 2;
/*
set md width
 */
$mdColWidth = 3;
/*
set sm width
 */
$smColWidth = 4;
/*
set xs width
 */
$xsColWidth = 6;

if (isset($notesView)) {
    switch ($notesView) {
        case 'record':
            $lgColWidth = 12;
            $mdColWidth = 12;
            $smColWidth = 6;
            $xsColWidth = 6;
            break;
    }
}
?>

<div class="row">
    <?php foreach ($notes as $k => $note) : ?>
    <div class="col-xs-<?= $xsColWidth ?> col-sm-<?= $smColWidth ?> col-md-<?= $mdColWidth ?> col-lg-<?= $lgColWidth ?>">
        <div class="alert alert-<?= $note->type ?> alert-dismissible note" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            <strong><?= $note->user->username ?></strong>
            <p><?= $note->content ?></p>
            <span class="actions">
                <?php if ($this->request->session()->read('Auth.User.id') === $note->user_id) : ?>
                <?= $this->Html->link('', [
                    'plugin' => 'notes',
                    'controller' => 'notes',
                    'action' => 'edit',
                    $note->id
                ], [
                    'title' => __('Edit'),
                    'class' => 'glyphicon glyphicon-pencil'
                ]) ?>
                <?= $this->Form->postLink('', [
                    'plugin' => 'notes',
                    'controller' => 'notes',
                    'action' => 'delete',
                    $note->id
                ], [
                    'confirm' => __('Are you sure you want to delete # {0}?', $note->id),
                    'title' => __('Delete'),
                    'class' => 'glyphicon glyphicon-trash'
                ]) ?>
                <?php endif; ?>
            </span>
        </div>
    </div>
    <?php endforeach; ?>
</div>