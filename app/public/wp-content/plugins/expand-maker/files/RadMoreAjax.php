<?php
class RadMoreAjax {
	
	public function init() {
		
		add_action('wp_ajax_delete_rm', array($this, 'deleteRm'));
		add_action('wp_ajax_yrm_delete_readmores', array($this, 'deleteReadMores'));
		add_action('wp_ajax_yrm_type_delete', array($this, 'typeDelete'));
		add_action('wp_ajax_yrm_switch_status', array($this, 'switchStatus'));
		add_action('wp_ajax_yrm_far_status', array($this, 'farStatus'));
		add_action('wp_ajax_yrm_export', array($this, 'exportData'));
		add_action('wp_ajax_yrm_import_data', array($this, 'importData'));

		// review panel
		add_action('wp_ajax_yrm_dont_show_review_notice', array($this, 'dontShowReview'));
		add_action('wp_ajax_yrm_change_review_show_period', array($this, 'changeReviewPeriod'));

		add_action('wp_ajax_yrm_support', array($this, 'support'));
		add_action('wp_ajax_expander_storeSurveyResult', array($this, 'surveyResult'));
	}

	public function surveyResult() {
		check_ajax_referer('readMoreAjaxNonce', 'token');
		$str = $_POST['savedData'];
		parse_str($str, $savedData);

		$headers  = 'MIME-Versions: 1.0'."\r\n";
		//$headers .= 'From: '.$sendFromEmail.''."\r\n";
		$headers .= 'Content-types: text/plain; charset=UTF-8'."\r\n";
		$message = '<b>Product</b>: Read more<br>';
		$message .= '<b>Version</b>: '.EXPM_VERSION.'<br>';
		
		if (empty($savedData['expander_reason_key'])) {
			$message .= 'Skip <br>';
		}
		else {
			foreach ($savedData as $key => $value) {
				if (empty($value)) {
					continue;
				}
				$message .= '<b>'.$key.'</b>: '.$value.'<br>';
			}
		}

		$sendStatus = wp_mail('xavierveretu@gmail.com', 'Read More Deactivate Survey', $message, $headers);
		echo 1;
		die;
	}

	public function support() {
		check_ajax_referer('YrmNonce', 'ajaxNonce');
		parse_str($_POST['formData'], $params);

		$headers  = 'MIME-Versions: 1.0'."\r\n";
		//$headers .= 'From: '.$sendFromEmail.''."\r\n";
		$headers .= 'Content-types: text/plain; charset=UTF-8'."\r\n";
		$message = '<b>Report type</b>: '.$params['report_type'].'<br>';
		$message .= '<b>Name</b>: '.$params['name'].'<br>';
		$message .= '<b>Email</b>: '.$params['email'].'<br>';
		$message .= '<b>Website</b>: '.$params['website'].'<br>';
		$message .= '<b>Message</b>: '.$params['yrm-message'].'<br>';
		$message .= '<b>version</b>: '.ReadMoreAdminHelper::getVersionString().'<br>';

		$sendStatus = false;
		$sendStatus = wp_mail('edmon.parker@gmail.com', 'Web site support Read More', $message, $headers);

		echo $sendStatus;
		die();
	}

	public function changeReviewPeriod() {
		check_ajax_referer('YrmNonce', 'ajaxNonce');
		$messageType = sanitize_text_field($_POST['messageType']);

		$timeDate = new DateTime('now');
		$timeDate->modify('+'.YRM_SHOW_REVIEW_PERIOD.' day');

		$timeNow = strtotime($timeDate->format('Y-m-d H:i:s'));
		update_option('YrmShowNextTime', $timeNow);
		$usageDays = get_option('YrmUsageDays');
		$usageDays += YRM_SHOW_REVIEW_PERIOD;
		update_option('YrmUsageDays', $usageDays);

		echo YCD_AJAX_SUCCESS;
		wp_die();
	}

	public function dontShowReview() {
		check_ajax_referer('yrmReviewNotice', 'ajaxNonce');
		update_option('YrmDontShowReviewNotice', 1);

		echo 1;
		wp_die();
	}
	
	public function importData()
	{
		check_ajax_referer('YrmNonce', 'ajaxNonce');
		$url = sanitize_text_field($_POST['attachmentUrl']);
		$contents = unserialize(base64_decode(file_get_contents($url)));
		global $wpdb;
		
		foreach ($contents as $tableName => $tableData) {
			foreach ($tableData as $rowData) {
				$values = "'".implode(array_values($rowData), "','")."'";
				$columns = "`".implode(array_keys($rowData), "`, ")."'";
				$contentsStr = '';
				foreach (array_keys($rowData) as $key => $value) {
					$contentsStr .= '`'.$value.'`'.', ';
				}
				$contentsStr = rtrim($contentsStr, ', ');
				$customInsertSql = $wpdb->prepare("INSERT INTO ".$wpdb->prefix.$tableName."($contentsStr) VALUES ($values)");
				$wpdb->query($customInsertSql);
			}
		}
		wp_die();
	}
	
	public function exportData() {
		check_ajax_referer('YrmNonce', 'ajaxNonce');
		global $wpdb;
		$data = array();
		
		$tables = array('expm_maker', 'expm_maker_pages');
		
		foreach ($tables as $table) {
			$dataSql = 'SELECT * FROM '.$wpdb->prefix.$table;
			$getAllData = $wpdb->get_results($dataSql, ARRAY_A);
			$currentTable = array();
			foreach ($getAllData as $currentData) {
				$currentTable[] =  $currentData;
			}
			$data[$table] = $currentTable;
		}
		
		print base64_encode(serialize($data));
		wp_die();
	}
	
	public function deleteRm() {

		check_ajax_referer('YrmNonce', 'ajaxNonce');
		$id  = (int)$_POST['readMoreId'];
		
		$this->deleteById($id);
		
		echo '';
		die();
	}
	
	public function deleteById($id) {
		$dataObj = new ReadMoreData();
		$dataObj->setId($id);
		$dataObj->delete();
		
		do_action('YrmDeleteReadMore', $id);
	}
	
	public function deleteReadMores() {
		check_ajax_referer('YrmNonce', 'ajaxNonce');
		$list = $_POST['idsList'];
		
		if (is_array($list) && !empty($list)) {
			foreach ($list as $currentId) {
				$this->deleteById($currentId);
			}
		}
		
		echo '1';
		wp_die();
	}

	public function typeDelete() {

		check_ajax_referer('YrmNonce', 'ajaxNonce');
		$id  = (int)$_POST['id'];
		$type  = $_POST['type'];


		$typeObj = ReadMore::createObjByType('far');
		$typeObj->setSavedId($id);
		$typeObj->delete();

		do_action('YrmTypeDeleteReadMore', $id);

		echo '';
		die();
	}

	public function switchStatus() {
		check_ajax_referer('YrmNonce', 'ajaxNonce');
		$postId = $_POST['readMoreId'];
		$status = -1;

		if ($_POST['isChecked'] == 'true') {
			$status = true;
		}
		update_option('yrm-read-more-'.$postId, $status);
		wp_die();
	}

	public function farStatus() {
		check_ajax_referer('YrmNonce', 'ajaxNonce');
		$postId = $_POST['id'];
		$status = 0;

		if ($_POST['isChecked'] == 'true') {
			$status = 1;
		}
		global $wpdb;
		$prepare = $wpdb->prepare('UPDATE '.$wpdb->prefix.YRM_FIND_TABLE.' SET enable = %s WHERE id=%d', $status, $postId);
		$wpdb->query($prepare);
		echo 1;
		wp_die();
	}
}