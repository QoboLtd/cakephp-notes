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
