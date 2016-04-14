<?php
$relatedId = null;
if (isset($this->request->params['pass']) && !empty($this->request->params['pass'][0])) {
    $relatedId = $this->request->params['pass'][0];
}
?>
<?= $this->cell('Notes.Notes::recordNotes', [
    $this->request->params['controller'],
    $relatedId
]); ?>