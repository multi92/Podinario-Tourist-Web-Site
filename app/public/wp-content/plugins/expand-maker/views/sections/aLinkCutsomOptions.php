<?php
$savedIcon = $dataObj->getOptionValue('yrm-button-icon');
$hideRemoveButton = 'yrm-hide';
if($savedIcon != YRM_BUTTON_ICON_URL) {
	$hideRemoveButton = '';
}
$proSpan = ReadMoreAdminHelper::getLabelProSpan();
$optionPkgClassName = ReadMoreAdminHelper::getOptionPkgClassName();
?>
<div class="panel panel-default yrm-pro-options-wrapper">
	<div class="panel-heading"><?php _e('Custom options', YRM_LANG);?></div>
	<div class="panel-body">
		<div class="row row-static-margin-bottom">
			<div class="col-xs-6">
				<label class="control-label" for="textinput"><?php _e('URL', YRM_LANG);?></label>
			</div>
			<div class="col-xs-6">
				<input type="url" class="input-md form-control" placeholder="https://" name="link-button-url" value="<?php echo esc_attr($dataObj->getOptionValue('link-button-url'))?>"><br>
			</div>
		</div>
		<div class="row row-static-margin-bottom">
			<div class="col-xs-6">
				<label class="control-label" for="link-button-new-tab"><?php _e('Redirect to new tab', YRM_LANG);?></label>
			</div>
			<div class="col-xs-6">
				<div class="yrm-switch-wrapper">
					<label class="yrm-switch">
						<input type="checkbox" name="link-button-new-tab" id="link-button-new-tab" class="" <?php echo $dataObj->getOptionValue('link-button-new-tab', true); ?>>
						<span class="yrm-slider yrm-round"></span>
					</label>
				</div>
			</div>
		</div>
		<div class="row row-static-margin-bottom">
			<div class="col-xs-6">
				<label class="control-label" for="linkButtonConfirm"><?php _e('Enable Confirm Window', YRM_LANG); echo $proSpan; ?>:</label>
			</div>
			<div class="col-xs-6 <?php echo $optionPkgClassName; ?>">
				<div class="yrm-switch-wrapper">
					<label class="yrm-switch">
						<input type="checkbox" name="link-button-confirm" id="linkButtonConfirm" class="yrm-accordion-checkbox" <?php echo $dataObj->getOptionValue('link-button-confirm', true); ?>>
						<span class="yrm-slider yrm-round"></span>
					</label>
				</div>
			</div>
		</div>
		<div class="yrm-accordion-content">
			<div class="row row-static-margin-bottom">
				<div class="col-xs-6">
					<label class="control-label" for="textinput"><?php _e('Text', YRM_LANG);?></label>
				</div>
				<div class="col-xs-6">
					<input type="text" class="input-md form-control" name="link-button-confirm-text" value="<?php echo esc_attr($dataObj->getOptionValue('link-button-confirm-text'))?>"><br>
				</div>
			</div>
		</div>
	</div>
</div>