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

use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;

echo $this->Html->css('Notes.notes', ['block' => 'css']);

$inPluginView = 'Notes' === $this->request->getParam('plugin');
// set viewport widths
if ($inPluginView) {
    $viewport = ['lg' => 2, 'md' => 3, 'sm' => 4, 'xs' => 6];
    $dividers = [
        'lg' => 12 / $viewport['lg'],
        'md' => 12 / $viewport['md'],
        'sm' => 12 / $viewport['sm'],
        'xs' => 12 / $viewport['xs'],
    ];
} else {
    $viewport = ['lg' => 12, 'md' => 12, 'sm' => 6, 'xs' => 6];
}
?>

<div class="row">
<?php foreach ($notes as $k => $note) : ?>
    <div class="col-xs-<?= $viewport['xs'] ?> col-sm-<?= $viewport['sm'] ?> col-md-<?= $viewport['md'] ?> col-lg-<?= $viewport['lg'] ?>">
        <div class="box box-<?= $note->type ?> box-solid note">
            <div class="box-header with-border">
                <span class="fa fa-<?= $shared[$note->shared]['icon'] ?>" aria-hidden="true" title="<?= $shared[$note->shared]['label'] ?>"></span>
                <strong title="Author"><?= $note->get('user') ? $note->get('user')->get('username') : '' ?></strong>
                <span class="actions pull-right">
                <?php if ($this->request->getSession()->read('Auth.User.id') === $note->user_id) : ?>
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
            <div class="box-body" style="color:initial;">
                <?= $this->Text->autoParagraph($note->content) ?>
            </div>
            <div class="box-footer small">
                <?php
                $relatedLink = [];
                if ($note->has('related_model') && $note->has('related_id')) {
                    try {
                        $relatedTable = TableRegistry::get($note->related_model);

                        $moduleName = Inflector::humanize(Inflector::underscore($relatedTable->alias()));

                        $icon = 'sticky-note-o';
                        if (method_exists($relatedTable, 'icon')) {
                            $icon = $relatedTable->icon();
                        }

                        $relatedEntity = $relatedTable->get($note->related_id);

                        $relatedLink['icon'] = $icon;
                        $relatedLink['title'] = $relatedEntity->{$relatedTable->displayField()};

                        $relatedLink['options'] = ['title' => $moduleName, 'escape' => false];

                        $url = [];
                        $url['action'] = 'view';
                        list($url['plugin'], $url['controller']) = pluginSplit($note->related_model);
                        array_push($url, $note->related_id);

                        $relatedLink['url'] = $url;
                    } catch (\Exception $e) {
                        //
                    }
                }

                if (!empty($relatedLink)) {
                    $htmlIcon = $this->Html->tag('i', '', [
                        'class' => 'fa fa-' . $relatedLink['icon'],
                        'title' => $relatedLink['options']['title']
                    ]);
                    echo $this->Html->link($htmlIcon, $relatedLink['url'], $relatedLink['options']);
                    echo '&nbsp;&nbsp;';
                    echo $this->Html->link($relatedLink['title'], $relatedLink['url'], $relatedLink['options']);
                } else {
                    echo '&nbsp;';
                }

                echo $this->Html->tag('span', $note->modified->i18nFormat('yyyy-MM-dd HH:mm'), [
                    'class' => 'pull-right text-muted',
                    'title' => __('Last modified')
                ]);
                ?>
            </div>
        </div>
    </div>
    <?php
    if (!$inPluginView) {
        continue;
    }

    $pointer = $k + 1;
    // add clearfix classes
    foreach ($dividers as $size => $divider) {
        if (!is_int($pointer / $divider)) {
            continue;
        }

        echo $this->Html->tag('div', '', ['class' => 'clearfix visible-' . $size . '-block']);
    }
    ?>
<?php endforeach; ?>
</div>
