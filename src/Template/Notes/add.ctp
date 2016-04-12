<div class="row">
    <div class="col-xs-12">
        <?= $this->Form->create($note); ?>
        <fieldset>
            <legend><?= __('Add {0}', ['Note']) ?></legend>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">&nbsp;</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <?= $this->Form->input('type', ['options' => $types, 'empty' => true]); ?>
                        </div>
                        <div class="col-xs-6">
                            <?= $this->Form->input('shared', ['options' => $shared, 'empty' => true]); ?>
                        </div>
                        <div class="col-xs-6">
                            <?= $this->Form->input('title'); ?>
                        </div>
                        <div class="col-xs-6">
                            <?= $this->Form->input('content'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
