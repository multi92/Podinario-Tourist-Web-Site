<?php
$params = ReadMoreData::params();
$userRoles = $params['userRoles'];
$dontDeleteData = (get_option('yrm-delete-data') ? 'checked': '');
$farMenu = (get_option('yrm-hid-find-and-replace-menu') ? 'checked': '');
?>
<div class="ycf-bootstrap-wrapper yrm-settings">
	<?php if(!empty($_GET['saved'])) : ?>
		<div id="default-message" class="updated notice notice-success is-dismissible">
			<p><?php echo _e('Settings saved.', YRM_LANG);?></p><button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php echo _e('Dismiss this notice.', YRM_LANG);?></span></button>
		</div>
	<?php endif; ?>
<div class="row">
	<div class="col-md-6">
        <form action="<?php echo admin_url().'admin-post.php?action=yrmSaveSettings'?>" method="post">
        <?php wp_nonce_field('YRM_ADMIN_POST_NONCE', YRM_ADMIN_POST_NONCE);?>
		<div class="panel panel-default">
			<div class="panel-heading"><?php _e('Settings', YRM_LANG);?></div>
			<div class="panel-body">
                <div class="row form-group">
                    <div class="col-md-4">
                        <label class="ycd-label-of-switch" for="yrm-dont-delete-data"><?php _e('Remove Settings', YRM_LANG); ?></label>
                    </div>
                    <div class="col-md-2">
                        <div class="yrm-switch-wrapper">
                            <label class="yrm-switch">
                                <input type="checkbox" id="yrm-dont-delete-data" name="yrm-dont-delete-data" class="yrm-accordion-checkbox" <?php echo $dontDeleteData; ?> >
                                <span class="yrm-slider yrm-round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="ycd-label-of-switch">
                            <?php _e('This option will remove all settings and styles when <b>Delete plugin</b>', YRM_LANG); ?>
                        </label>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-4">
                        <label class="ycd-label-of-switch" for="yrm-hid-find-and-replace-menu"><?php _e('Hide Find And Replace Menu', YRM_LANG); ?></label>
                    </div>
                    <div class="col-md-2">
                        <div class="yrm-switch-wrapper">
                            <label class="yrm-switch">
                                <input type="checkbox" id="yrm-hid-find-and-replace-menu" name="yrm-hid-find-and-replace-menu" class="" <?php echo $farMenu; ?> >
                                <span class="yrm-slider yrm-round"></span>
                            </label>
                        </div>
                    </div>
                </div>
				<div class="row form-group">
					<div class="col-md-4">
                        <label>
	                        <?php _e('User role who can use plugin', YRM_LANG);?>
                        </label>
					</div>
					<div class="col-md-8">
                        <?php echo $functions::yrmSelectBox($userRoles, get_option('yrm-user-roles'), array('name' => 'yrm-user-roles[]', 'multiple' => 'multiple', 'class' => 'yrm-js-select2'));?>
                    </div>
				</div>
                <div class="row">
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-primary" value="<?php _e('Save changes', YRM_LANG); ?>">
                    </div>
                </div>
			</div>
		</div>
        </form>
	</div>
</div>
</div>