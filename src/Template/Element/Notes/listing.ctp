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

$relatedId = $this->request->getParam('pass.0');
if (! $relatedId) {
    return;
}

$relatedModel = $this->request->getParam('controller');
if ($this->request->getParam('plugin')) {
    $relatedModel = $this->request->getParam('plugin') . '.' . $relatedModel;
}

echo $this->cell('Notes.Notes::listing', [
    $relatedModel,
    $relatedId
]);
