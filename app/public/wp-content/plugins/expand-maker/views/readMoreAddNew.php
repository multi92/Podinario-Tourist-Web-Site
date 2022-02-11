<?php
$currentExtensions = YrmConfig::extensions();
$extensionsResult = ReadMoreAdminHelper::separateToActiveAndNotActive($currentExtensions);
$upgradeButton = '';

if (YRM_PKG == YRM_FREE_PKG) {
	$upgradeButton = ReadMoreAdminHelper::upgradeButton();
}
?>
<div class="ycf-bootstrap-wrapper">
	<h3>Add New Read More Type <?php echo $upgradeButton; ?></h3>
    <div class="add-new-hr"></div>
	<div class="product-banner" onclick="location.href = '<?php echo admin_url();?>admin.php?page=button&yrm_type=button'">
		<div class="yrm-types yrm-button"></div>
		<div class="yrm-type-view-footer">
			<span class="yrm-promotion-title"><?php _e('Button', YRM_LANG);?></span>
		</div>
	</div>
	<div class="product-banner" onclick="location.href = '<?php echo admin_url();?>admin.php?page=button&yrm_type=inline'">
		<div class="yrm-types yrm-inline"></div>
		<div class="yrm-type-view-footer">
			<span class="yrm-promotion-title"><?php _e('Inline', YRM_LANG);?></span>
		</div>
	</div>
    <?php foreach ($extensionsResult['active'] as $extension): ?>
        <div class="product-banner" onclick="location.href = '<?php echo admin_url();?>admin.php?page=button&yrm_type=<?php echo esc_attr($extension['shortKey']);?>'">
            <div class="yrm-types yrm-<?php echo esc_attr($extension['shortKey']);?>"></div>
            <div class="yrm-type-view-footer">
                <span class="yrm-promotion-title"><?php _e($extension['boxTitle'], YRM_LANG);?></span>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="product-banner" onclick="location.href = '<?php echo admin_url();?>admin.php?page=button&yrm_type=link'">
        <div class="yrm-types yrm-link"></div>
        <div class="yrm-type-view-footer">
            <span class="yrm-promotion-title"><?php _e('Link button', YRM_LANG);?></span>
        </div>
    </div>
    <div class="product-banner" onclick="location.href = '<?php echo admin_url();?>admin.php?page=button&yrm_type=alink'">
        <div class="yrm-types yrm-alink"></div>
        <div class="yrm-type-view-footer">
            <span class="yrm-promotion-title"><?php _e('Link', YRM_LANG);?></span>
        </div>
    </div>
	<?php if(YRM_PKG > YRM_SILVER_PKG): ?>
		<div class="product-banner" onclick="location.href = '<?php echo admin_url();?>admin.php?page=button&yrm_type=popup'">
			<div class="yrm-types yrm-popup"></div>
			<div class="yrm-type-view-footer">
				<span class="yrm-promotion-title"><?php _e('Button & popup', YRM_LANG);?></span>
			</div>
		</div>
        <div class="product-banner" onclick="location.href = '<?php echo admin_url();?>admin.php?page=button&yrm_type=inlinePopup'">
			<div class="yrm-types yrm-inline-popup"></div>
			<div class="yrm-type-view-footer">
				<span class="yrm-promotion-title"><?php _e('Inline & popup', YRM_LANG);?></span>
			</div>
		</div>
	<?php endif?>
	<?php if(YRM_PKG == YRM_FREE_PKG): ?>
		<a class="product-banner" href="<?php echo YRM_PRO_URL; ?>" target="_blank">
			<div class="yrm-types yrm-popup type-banner-pro">
				<p class="yrm-type-title-pro">PRO Features</p>
			</div>
			<div class="yrm-type-view-footer">
				<span class="yrm-promotion-title"><?php _e('Button & popup', YRM_LANG);?></span>
                <span class="yrm-play-promotion-video" data-href="<?php echo YRM_POPUP_VIDEO; ?>"></span>
			</div>
		</a>
        <a class="product-banner" href="<?php echo YRM_PRO_URL; ?>" target="_blank">
			<div class="yrm-types yrm-inline-popup type-banner-pro">
				<p class="yrm-type-title-pro">PRO Features</p>
			</div>
			<div class="yrm-type-view-footer">
				<span class="yrm-promotion-title"><?php _e('Inline & popup', YRM_LANG);?></span>
                <span class="yrm-play-promotion-video" data-href="<?php echo YRM_POPUP_VIDEO; ?>"></span>
			</div>
		</a>
	<?php endif?>
</div>
<?php

if(!empty($extensionsResult['passive'])) : ?>
<div class="yrm-add-new-extensions-wrapper">
	<span class="yrm-add-new-extensions">
		Extensions
	</span>
</div>
    <?php if (!empty($extensionsResult['comingSoon'])): ?>
        <?php foreach ($extensionsResult['comingSoon'] as $extension): ?>
            <?php include(YRM_TEMPLATES_FIND.'extensionBox.php');?>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php foreach ($extensionsResult['passive'] as $extension): ?>
        <?php include(YRM_TEMPLATES_FIND.'extensionBox.php');?>
    <?php endforeach; ?>
<?php endif; ?>
<div class="yrm-add-new-extensions-wrapper">
	<span class="yrm-add-new-extensions">
		More plugins
	</span>
</div>
<div class="yrm-add-new-plugins">
	<?php require_once(dirname(__FILE__).'/morePlugins.php')?>
</div>

