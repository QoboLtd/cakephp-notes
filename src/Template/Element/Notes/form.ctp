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

echo $this->cell('Notes.Notes::form', [
    $relatedModel,
    $relatedId
]);

echo $this->Html->scriptBlock(
    '$("#color-chooser > li > a").click(function (e) {
        e.preventDefault();
        // save color
        currColor = $(this).css("color");
        // add color effect to button
        $("#add-new-note").css({"background-color": currColor, "border-color": currColor});
        // save value
        currValue = $(this).data("value");
        // add value to "type" input
        $("[name=\'Notes[type]\']").val(currValue);
    });
    $("#shared-chooser > li > a").click(function (e) {
        e.preventDefault();
        // save icon
        currIcon = $(this).children("i").attr("class");
        // add icon to button
        $("#add-new-note").children("i").removeClass().addClass(currIcon);
        // save value
        currValue = $(this).data("value");
        // add value to "type" input
        $("[name=\'Notes[shared]\']").val(currValue);
    });',
    ['block' => 'scriptBottom']
);
