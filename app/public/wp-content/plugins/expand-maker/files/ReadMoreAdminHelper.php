<?php

class ReadMoreAdminHelper {
	public static function getPluginActivationUrl($key) {
		$action = 'install-plugin';
		$contactFormUrl = wp_nonce_url(
			add_query_arg(
				array(
					'action' => $action,
					'plugin' => $key
				),
				admin_url( 'update.php' )
			),
			$action.'_'.$key
		);

		return $contactFormUrl;
	}

	public static function getVersionString() {
	    $version = 'YRM_VERSION='.EXPM_VERSION;
	    if(YRM_PKG > YRM_FREE_PKG) {
		    $version = 'YRM_VERSION_PRO=' . EXPM_VERSION_PRO.";";
	    }

	    return $version;
    }

    public static function separateToActiveAndNotActive($extensions) {
        $result = array(
          'active' => array(),
          'passive' => array()
        );

        foreach($extensions as $extension) {
            if(empty($extension)) {
                continue;
            }
            $key = @$extension['pluginKey'];

            if(is_plugin_active($key)) {
                if($extension['isType']) {
                    $result['active'][] = $extension;
                }
            }
            else if (!empty($extension['comingSoon']) && $extension['comingSoon']) {
	            $result['comingSoon'][] = $extension;
            }
             else {
                $result['passive'][] = $extension;
            }
        }

        return $result;
    }

    public static function getLabelProSpan() {
        $proSpan = '';
        if(YRM_PKG == YRM_FREE_PKG) {
            $proSpan = '<a class="yrm-pro-span" href="'.YRM_PRO_URL.'" target="_blank">'.__('pro', YRM_LANG).'</a>';
        }

        return $proSpan;
    }

    public static function getOptionPkgClassName() {
        $optionPkgClassName = 'yrm-option-wrapper';
        if(YRM_PKG == YRM_FREE_PKG) {
            $optionPkgClassName .= '-pro';
        }

        return $optionPkgClassName;
    }
    
    public static function getTitleFromType($type) {
		$title = '';

		$typeTitles = array(
			'button' => __('Button', YRM_LANG),
			'inline' => __('Inline', YRM_LANG),
			'link' => __('Link button', YRM_LANG),
			'alink' => __('Link', YRM_LANG),
			'popup' => __('Button & popup', YRM_LANG),
			'inlinePopup' => __('Inline & popup', YRM_LANG),
			'scroll' => __('Scroll to top', YRM_LANG),
			'yrm-forms' => __('Read More Login & Registration forms', YRM_LANG),
			'proVersion' => __('Read more & popup', YRM_LANG),
			'analytics' => __('Analytics', YRM_LANG),
			'subscription' => __('Subscription', YRM_LANG)
		);

		$typeTitles = apply_filters('yrmTypeTitles', $typeTitles);

		if (!empty($typeTitles[$type])) {
			$title = $typeTitles[$type];
		}
		
		return $title;
    }
	
	public static function getYoutubeEmbedUrl($url) {
		$shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
		$longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';
		
		if (preg_match($longUrlRegex, $url, $matches)) {
			$youtube_id = $matches[count($matches) - 1];
		}
		
		if (preg_match($shortUrlRegex, $url, $matches)) {
			$youtube_id = $matches[count($matches) - 1];
		}
		return 'https://www.youtube.com/embed/' . $youtube_id ;
	}
	
	/**
	 * Update options
	 *
	 * @since 2.5.3
	 *
	 * @return void
	 */
	public static function updateOption($optionKey, $optionValue)
	{
		if (is_multisite()) {
			update_site_option($optionKey, $optionValue);
		}
		else {
			update_option($optionKey, $optionValue);
		}
	}
	
	public static function getOption($optionKey)
	{
		if (is_multisite()) {
			return get_site_option($optionKey);
		}
		return get_option($optionKey);
	}
	
	public static function deleteOption($optionKey)
	{
		if (is_multisite()) {
			delete_site_option($optionKey);
		}
		else {
			delete_option($optionKey);
		}
	}

	public static function reportIssueButton() {
		$button = '<a href="'.YRM_SUPPORT_URL.'" target="_blank"><button type="button" id="yrm-report-problem-button" class="yrm-button-red">
					<i class="glyphicon glyphicon-alert"></i>
					Report issue</button>
					</a>';

		return $button;
	}

	public static function upgradeButton() {
		$button = '<button class="yrm-upgrade-button-orange yrm-link-button" onclick=\'window.open("'.YRM_PRO_URL.'");\'>
						<b class="h2">Upgrade</b><br><span class="h5">to PRO version</span>
					</button>';

		return $button;
	}
}