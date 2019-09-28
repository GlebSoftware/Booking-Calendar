<?php
if (isset($tpl['status']))
{
	$status = __('status', true);
	switch ($tpl['status'])
	{
		case 2:
			pjUtil::printNotice(NULL, $status[2]);
			break;
	}
} else {
	$titles = __('error_titles', true);
	$bodies = __('error_bodies', true);
	if (isset($_GET['err']))
	{
		pjUtil::printNotice(@$titles[$_GET['err']], @$bodies[$_GET['err']]);
	}
	?>
	
	<?php pjUtil::printNotice(@$titles['ACR10'], @$bodies['ACR10']); ?>
	
	<div class="b10">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" class="float_left r5">
			<input type="hidden" name="controller" value="pjAdminCalendars" />
			<input type="hidden" name="action" value="pjActionCreate" />
			<input type="submit" class="pj-button" value="<?php __('btnAddCalendar'); ?>" />
		</form>
		<form action="" method="get" class="float_left pj-form frm-filter">
			<input type="text" name="q" class="pj-form-field pj-form-field-search w150" placeholder="<?php __('btnSearch'); ?>" />
		</form>
		<div class="float_right t5"></div>
		<br class="clear_both" />
	</div>

	<div id="grid"></div>
	<script type="text/javascript">
	var pjGrid = pjGrid || {};
	pjGrid.currentCalendarId = <?php echo $controller->getForeignId(); ?>;
	pjGrid.queryString = "";
	var myLabel = myLabel || {};
	myLabel.prices = "<?php __('plugin_price_menu', false, true); ?>";
	myLabel.settings = "<?php __('menuSettings'); ?>";
	myLabel.edit = "<?php __('lblEdit'); ?>";
	myLabel.delete = "<?php __('lblDelete'); ?>";
	myLabel.installPreview = "<?php __('menuInstallPreview'); ?>";
	myLabel.viewReservations = "<?php __('lblViewReservations'); ?>";
	myLabel.viewCalendar = "<?php __('lblViewCalendar'); ?>";
	myLabel.more = "<?php __('lblMore'); ?>";
	myLabel.user = "<?php __('lblUser'); ?>";
	myLabel.id = "<?php __('lblID'); ?>";
	myLabel.calendar = "<?php __('lblCalendarName'); ?>";
	myLabel.deleteSelected = "<?php __('lblDeleteSelected'); ?>";
	myLabel.deleteConfirmation = "<?php __('lblDeleteConfirmation'); ?>";
	</script>
	<?php
}
?>