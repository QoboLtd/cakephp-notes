<?php
$relatedId = null;
if (isset($this->request->params['pass']) && !empty($this->request->params['pass'][0])) {
    $relatedId = $this->request->params['pass'][0];
}
$relatedModel = $this->request->controller;
if ($this->request->plugin) {
    $relatedModel = $this->request->plugin . '.' . $relatedModel;
}

echo $this->cell('Notes.Notes::listing', [
    $relatedModel,
    $relatedId
]);