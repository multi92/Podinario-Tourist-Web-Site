<?php
use yrm\DisplayConditionBuilder;

$savedData = $typeObj->getOptionValue('yrm-display-settings');
$obj = new DisplayConditionBuilder();
$obj->setSavedData($savedData);
$data = $obj->filterForSave();
$obj->setSavedData($data);
?>

<div class="yrm-bootstrap-wrapper">
	<?php echo $obj->render(); ?>
</div>