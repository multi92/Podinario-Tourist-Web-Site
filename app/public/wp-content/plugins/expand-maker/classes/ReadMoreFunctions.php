<?php

class ReadMoreFunctions {

	public static function createSelectBox($params, $name, $selectedValue) {

		$selectBox = "<select name='".$name."' class=\"selectpicker input-md yrm-js-select2\">";
		foreach ($params as $value => $name) {
			$selected = "";
			if($value == $selectedValue) {
				$selected = "selected";
			}
			$selectBox .= "<option value='".$value."' $selected>$name</option>";
		}
		$selectBox .= "</select>";
		return $selectBox;
	}

	public static function yrmSelectBox($data, $selectedValue, $attrs) {

 		$attrString = '';
		$selected = '';
		
		if(!empty($attrs) && isset($attrs)) {

			foreach ($attrs as $attrName => $attrValue) {
				$attrString .= ''.$attrName.'="'.$attrValue.'" ';
			}
		}

		$selectBox = '<select '.$attrString.'>';

		if (!empty($data)) {
			foreach ($data as $value => $label) {

				/*When is multiselect*/
				if(is_array($selectedValue)) {
					$isSelected = in_array($value, $selectedValue);
					if($isSelected) {
						$selected = 'selected';
					}
				}
				else if($selectedValue == $value) {
					$selected = 'selected';
				}
				else if(is_array($value) && in_array($selectedValue, $value)) {
					$selected = 'selected';
				}

				$selectBox .= '<option value="'.$value.'" '.$selected.'>'.$label.'</option>';
				$selected = '';
			}
        }

		$selectBox .= '</select>';

		return $selectBox;
 	}

	public static function createRadioButtons($data, $savedValue, $attrs) {

		$attrString = '';
		$selected = '';

		if(!empty($attrs) && isset($attrs)) {

			foreach ($attrs as $attrName => $attrValue) {
				$attrString .= ''.$attrName.'="'.$attrValue.'" ';
			}
		}

	    $radioButtons = '';

		foreach($data as $value) {

			$checked = '';
			if($value == $savedValue) {
				$checked = 'checked';
			}

			$radioButtons .= "<input type=\"radio\" value=\"$value\" $attrString  $checked>";
		}
		return $radioButtons;
	}

	public static function getFooterReviewBlock() {

		ob_start();
		?>
		<div class="clear"></div>
		<div class="yrmAdminFooterShell">
			<div class="yrmAdminFooterShell">
				Read More by Edmon		Version:
				<a target="_blank" href="http://wordpress.org/plugins/contact-form-by-supsystic/changelog/"><?php echo YRM_VERSION_TEXT; ?></a>
			</div>
			<?php if(YRM_PKG == YRM_FREE_PKG):?>
			<div class="yrmAdminFooterShell">|</div>
				<div class="yrmAdminFooterShell">
				Go&nbsp;<a target="_blank" href="<?php echo YRM_PRO_URL;?>">PRO</a>
			</div>
			<?php endif; ?>
			<div class="yrmAdminFooterShell">|</div>
				<div class="yrmAdminFooterShell">
				<a target="_blank" href="https://wordpress.org/support/plugin/expand-maker">Support</a>
			</div>
			<div class="yrmAdminFooterShell">|</div>
			<div class="yrmAdminFooterShell">
				Add your <a target="_blank" href="https://wordpress.org/support/plugin/expand-maker/reviews/?filter=5">★★★★★</a> on wordpress.org.
			</div>
		</div>
		<?php
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}

	public static function getPostTypeData($args = array())
	{
		$query = self::getQueryDataByArgs($args);

		$posts = array();
		foreach ($query->posts as $post) {
			$posts[$post->ID] = $post->post_title;
		}

		return $posts;
	}

	public static function getQueryDataByArgs($args = array())
	{
		$defaultArgs = array(
			'offset'           =>  0,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_status'      => 'publish',
			'suppress_filters' => true,
			'post_type'        => 'post',
			'posts_per_page'   => 1000
		);

		$args = wp_parse_args($args, $defaultArgs);
		$query = new WP_Query($args);

		return $query;
	}
}