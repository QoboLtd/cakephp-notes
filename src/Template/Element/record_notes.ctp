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
        <div class="box box-<?= $note->type ?> note">
            <div class="box-header with-border">
                <span class="fa <?= $note->shared === 'public' ? 'fa-eye' : 'fa-eye-slash'; ?>" aria-hidden="true"></span>
                <strong><?= $note->user->username ?></strong>
                <span class="actions">
                    <?php if ($this->request->session()->read('Auth.User.id') === $note->user_id) : ?>
                    <?= $this->Html->link('', [
                        'plugin' => 'notes',
                        'controller' => 'notes',
                        'action' => 'edit',
                        $note->id
                    ], [
                        'title' => __('Edit'),
                        'class' => 'fa fa-pencil'
                    ]) ?>
                    <?= $this->Form->postLink('', [
                        'plugin' => 'notes',
                        'controller' => 'notes',
                        'action' => 'delete',
                        $note->id
                    ], [
                        'confirm' => __('Are you sure you want to delete # {0}?', $note->id),
                        'title' => __('Delete'),
                        'class' => 'fa fa-trash'
                    ]) ?>
                    <?php endif; ?>
                </span>
            </div>
            <div class="box-body">
                <?= $this->Text->autoParagraph($note->content) ?>
            </div>
            <div class="box-footer small">
                <?php
                    $relatedLink = [];
                if ($note->has('related_model') && $note->has('related_id')) {
                    try {
                        $relatedTable = \Cake\ORM\TableRegistry::get($note->related_model);
                        $relatedEntity = $relatedTable->get($note->related_id);
                        $relatedLink['title'] = \Cake\Utility\Inflector::humanize(
                            \Cake\Utility\Inflector::underscore($relatedTable->alias())
                        ) . ' &gt; ';
                        $relatedLink['title'] .= $relatedEntity->{$relatedTable->displayField()};
                        $url['action'] = 'view';
                        list($url['plugin'], $url['controller']) = pluginSplit($note->related_model);
                        array_push($url, $note->related_id);
                        $relatedLink['url'] = $this->Url->build($url);
                    } catch (\Exception $e) {
                        //
                    }
                }
                ?>
                <?php if (!empty($relatedLink)) : ?>
                <a href="<?= $relatedLink['url']; ?>"><?= $relatedLink['title']; ?></a>
                <?php else : ?>
                    &nbsp;
                <?php endif; ?>
            </div>
        </div>
    </div><!--  <?= $k; ?> -->
    <?php endforeach; ?>
</div>
