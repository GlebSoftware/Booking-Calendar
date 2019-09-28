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
	if (isset($_GET['err']))
	{
		$titles = __('error_titles', true);
		$bodies = __('error_bodies', true);
		pjUtil::printNotice(@$titles[$_GET['err']], @$bodies[$_GET['err']]);
	}
	$week_start = isset($tpl['option_arr']['o_week_start']) && in_array((int) $tpl['option_arr']['o_week_start'], range(0,6)) ? (int) $tpl['option_arr']['o_week_start'] : 0;
	$jqDateFormat = pjUtil::jqDateFormat($tpl['option_arr']['o_date_format']);
	?>
	<div class="ui-tabs ui-widget ui-widget-content ui-corner-all b10">
		<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminReservations&amp;action=pjActionIndex"><?php __('menuReservations'); ?></a></li>
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminReservations&amp;action=pjActionExport"><?php __('lblExport'); ?></a></li>
		</ul>
	</div>
	
	<?php
	$titles = __('error_titles', true);
	$bodies = __('error_bodies', true);
	pjUtil::printNotice(__('infoUpdateReservationTitle', true), __('infoUpdateReservationDesc', true));
	
	$jquery_validation = __('jquery_validation', true);
	?>
	
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminReservations&amp;action=pjActionUpdate" method="post" id="frmUpdateReservation" class="form pj-form">
		<input type="hidden" name="reservation_update" value="1" />
		<input type="hidden" name="id" value="<?php echo $tpl['arr']['id']; ?>" />
		<input type="hidden" name="calendar_id" value="<?php echo $tpl['arr']['calendar_id']; ?>" />
		<input type="hidden" name="locale_id" value="<?php echo $tpl['arr']['locale_id']; ?>" />

		<fieldset class="fieldset white w350 float_left">
			<legend><?php __('lblReservationInfo'); ?></legend>
			<p>
				<label class="title"><?php __('lblReservationCalendar'); ?></label>
				<span class="left inline_block"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminCalendars&amp;action=pjActionView&id=<?php echo $tpl['arr']['calendar_id']; ?>"><?php echo htmlspecialchars(stripslashes($tpl['arr']['calendar_name'])); ?></a></span>
			</p>
			<p>
				<label class="title"><?php __('lblReservationStatus'); ?></label>
				<span class="inline_block">
					<select name="status" id="status" class="pj-form-field w170 required" data-msg-required="<?php echo $jquery_validation['required'];?>">
						<option value="">-- <?php __('lblChoose'); ?> --</option>
						<?php
						foreach (__('reservation_statuses', true) as $k => $v)
						{
							if (isset($tpl['arr']['status']) && $tpl['arr']['status'] == $k)
							{
								?><option value="<?php echo $k; ?>" selected="selected"><?php echo stripslashes($v); ?></option><?php
							} else {
								?><option value="<?php echo $k; ?>"><?php echo stripslashes($v); ?></option><?php
							}
						}
						?>
					</select>
				</span>
			</p>
			<p>
				<label class="title"><?php __('lblReservationUuid'); ?></label>
				<span class="inline_block">
					<input type="text" name="uuid" id="uuid" class="pj-form-field w170 required" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['uuid'])); ?>" data-msg-required="<?php echo $jquery_validation['required'];?>" />
				</span>
			</p>
			<p>
				<label class="title"><?php __('lblReservationFrom'); ?></label>
				<span class="pj-form-field-custom pj-form-field-custom-after">
					<input type="text" name="date_from" id="date_from" class="pj-form-field pointer w80 required" value="<?php echo pjUtil::formatDate($tpl['arr']['date_from'], "Y-m-d", $tpl['option_arr']['o_date_format']); ?>" readonly="readonly" rel="<?php echo $week_start; ?>" rev="<?php echo $jqDateFormat; ?>" data-msg-required="<?php echo $jquery_validation['required'];?>" />
					<span class="pj-form-field-after"><abbr class="pj-form-field-icon-date"></abbr></span>
				</span>
			</p>
			<p>
				<label class="title"><?php __('lblReservationTo'); ?></label>
				<span class="pj-form-field-custom pj-form-field-custom-after">
					<input type="text" name="date_to" id="date_to" class="pj-form-field pointer w80 required" readonly="readonly" rel="<?php echo $week_start; ?>" rev="<?php echo $jqDateFormat; ?>" value="<?php echo pjUtil::formatDate($tpl['arr']['date_to'], "Y-m-d", $tpl['option_arr']['o_date_format']); ?>" data-msg-required="<?php echo $jquery_validation['required'];?>"/>
					<span class="pj-form-field-after"><abbr class="pj-form-field-icon-date"></abbr></span>
					<input type="hidden" name="dates" id="dates" value="1" />
				</span>
			</p>
			<p>
				<label class="title">&nbsp;</label>
				<input type="submit" value="<?php __('btnSave'); ?>" class="pj-button" />
				<input type="button" value="<?php __('btnCalculate'); ?>" class="pj-button btnCalculate" />
				<a class="pj-form-langbar-tip listing-tip" href="#" title="<?php echo nl2br(__('reservation_calc_tip', true)); ?>"></a>
			</p>
		</fieldset>
		
		<fieldset class="fieldset white w330 float_right">
			<legend><?php __('lblReservationAmount'); ?></legend>
			<p>
				<label class="title"><?php __('lblReservationPayment'); ?></label>
				<span class="inline_block">
					<select name="payment_method" id="payment_method" class="pj-form-field w140">
					<option value="">-- <?php __('lblChoose'); ?> --</option>
					<?php
					foreach (__('payment_methods', true) as $k => $v)
					{
						?><option value="<?php echo $k; ?>"<?php echo $tpl['arr']['payment_method'] == $k ? ' selected="selected"' : NULL; ?>><?php echo $v; ?></option><?php
					}
					?>
					</select>
				</span>
			</p>
			<p class="vrCC" style="display: <?php echo $tpl['arr']['payment_method'] == 'creditcard' ? 'block' : 'none'; ?>"><label class="title"><?php echo __('lblReservationCCType'); ?></label>
				<select name="cc_type" class="pj-form-field w140">
				<option value="">---</option>
				<?php
				foreach (__('cc_types', true) as $k => $v)
				{
					?><option value="<?php echo $k; ?>"<?php echo $tpl['arr']['cc_type'] == $k ? ' selected="selected"' : NULL; ?>><?php echo $v; ?></option><?php
				}
				?>
				</select>
			</p>
			<p class="vrCC" style="display: <?php echo $tpl['arr']['payment_method'] == 'creditcard' ? 'block' : 'none'; ?>">
				<label class="title"><?php __('lblReservationCCNum'); ?></label>
				<input type="text" name="cc_num" id="cc_num" class="pj-form-field w120 digits" value="<?php echo $tpl['arr']['cc_num']; ?>" />
			</p>
			<p class="vrCC" style="display: <?php echo $tpl['arr']['payment_method'] == 'creditcard' ? 'block' : 'none'; ?>">
				<label class="title"><?php __('lblReservationCCCode'); ?></label>
				<input type="text" name="cc_code" id="cc_code" class="pj-form-field w120 digits" value="<?php echo $tpl['arr']['cc_code']; ?>" />
			</p>
			<p class="vrCC" style="display: <?php echo $tpl['arr']['payment_method'] == 'creditcard' ? 'block' : 'none'; ?>">
				<label class="title"><?php __('lblReservationCCExp'); ?></label>
				<?php
				echo pjTime::factory()
					->attr('name', 'cc_exp_month')
					->attr('id', 'cc_exp_month')
					->attr('class', 'pj-form-field')
					->prop('format', 'M')
					->prop('selected', $tpl['arr']['cc_exp_month'])
					->month();
					
				echo pjTime::factory()
					->attr('name', 'cc_exp_year')
					->attr('id', 'cc_exp_year')
					->attr('class', 'pj-form-field')
					->prop('selected', $tpl['arr']['cc_exp_year'])
					->prop('left', 5)
					->prop('right', 10)
					->year();
				?>
			</p>
			<p>
				<label class="title"><?php __('lblReservationPrice'); ?></label>
				<span class="pj-form-field-custom pj-form-field-custom-before">
					<span class="pj-form-field-before"><abbr class="pj-form-field-icon-text"><?php echo pjUtil::formatCurrencySign(NULL, $tpl['option_arr']['o_currency'], ""); ?></abbr></span>
					<input type="text" name="amount" id="amount" class="pj-form-field number w80" value="<?php echo $tpl['arr']['amount']; ?>" />
				</span>
			</p>
			<p>
				<label class="title"><?php __('lblReservationTax'); ?></label>
				<span class="pj-form-field-custom pj-form-field-custom-before">
					<span class="pj-form-field-before"><abbr class="pj-form-field-icon-text"><?php echo pjUtil::formatCurrencySign(NULL, $tpl['option_arr']['o_currency'], ""); ?></abbr></span>
					<input type="text" name="tax" id="tax" class="pj-form-field number w80" value="<?php echo $tpl['arr']['tax']; ?>" />
				</span>
			</p>
			<p>
				<label class="title"><?php __('lblReservationTotal'); ?></label>
				<span class="pj-form-field-custom pj-form-field-custom-before">
					<span class="pj-form-field-before"><abbr class="pj-form-field-icon-text"><?php echo pjUtil::formatCurrencySign(NULL, $tpl['option_arr']['o_currency'], ""); ?></abbr></span>
					<input type="text" name="total" id="total" class="pj-form-field w80" readonly="readonly" value="<?php echo number_format($tpl['arr']['amount'] + $tpl['arr']['tax'], 2); ?>" />
				</span>
			</p>
			<p style="display: none;">
				<label class="title"><?php __('lblReservationSecurity'); ?></label>
				<span class="pj-form-field-custom pj-form-field-custom-before">
					<span class="pj-form-field-before"><abbr class="pj-form-field-icon-text"><?php echo pjUtil::formatCurrencySign(NULL, $tpl['option_arr']['o_currency'], ""); ?></abbr></span>
					<input type="text" name="security" id="security" class="pj-form-field number w80" value="<?php echo $tpl['arr']['security']; ?>" />
				</span>
			</p>
			<p>
				<label class="title"><?php __('lblReservationDeposit'); ?></label>
				<span class="pj-form-field-custom pj-form-field-custom-before">
					<span class="pj-form-field-before"><abbr class="pj-form-field-icon-text"><?php echo pjUtil::formatCurrencySign(NULL, $tpl['option_arr']['o_currency'], ""); ?></abbr></span>
					<input type="text" name="deposit" id="deposit" class="pj-form-field number w80" value="<?php echo $tpl['arr']['deposit']; ?>" />
				</span>
			</p>
		</fieldset>
		
		<br class="clear_both" />
		
		<fieldset class="fieldset white">
			<legend><?php __('lblReservationClientInfo'); ?></legend>
			<?php if (in_array($tpl['option_arr']['o_bf_name'], array(2,3))) : ?>
			<p>
				<label class="title"><?php __('lblReservationName'); ?></label>
				<span class="inline_block">
					<input type="text" name="c_name" id="c_name" class="pj-form-field w300" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['c_name'])); ?>" />
				</span>
			</p>
			<?php endif; ?>
			<?php if (in_array($tpl['option_arr']['o_bf_email'], array(2,3))) : ?>
			<p>
				<label class="title"><?php __('lblReservationEmail'); ?></label>
				<span class="pj-form-field-custom pj-form-field-custom-before">
					<span class="pj-form-field-before"><abbr class="pj-form-field-icon-email"></abbr></span>
					<input type="text" name="c_email" id="c_email" class="pj-form-field email w300" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['c_email'])); ?>" />
				</span>
			</p>
			<?php endif; ?>
			<?php if (in_array($tpl['option_arr']['o_bf_phone'], array(2,3))) : ?>
			<p>
				<label class="title"><?php __('lblReservationPhone'); ?></label>
				<span class="pj-form-field-custom pj-form-field-custom-before">
					<span class="pj-form-field-before"><abbr class="pj-form-field-icon-phone"></abbr></span>
					<input type="text" name="c_phone" id="c_phone" class="pj-form-field w200" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['c_phone'])); ?>" />
				</span>
			</p>
			<?php endif; ?>
			<?php if (in_array($tpl['option_arr']['o_bf_address'], array(2,3))) : ?>
			<p>
				<label class="title"><?php __('lblReservationAddress'); ?></label>
				<span class="inline_block">
					<input type="text" name="c_address" id="c_address" class="pj-form-field w400" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['c_address'])); ?>" />
				</span>
			</p>
			<?php endif; ?>
			<?php if (in_array($tpl['option_arr']['o_bf_city'], array(2,3))) : ?>
			<p>
				<label class="title"><?php __('lblReservationCity'); ?></label>
				<span class="inline_block">
					<input type="text" name="c_city" id="c_city" class="pj-form-field w200" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['c_city'])); ?>" />
				</span>
			</p>
			<?php endif; ?>
			<?php if (in_array($tpl['option_arr']['o_bf_country'], array(2,3))) : ?>
			<p>
				<label class="title"><?php __('lblReservationCountry'); ?></label>
				<span class="inline_block">
					<select name="c_country" id="c_country" class="pj-form-field w300">
						<option value="">-- <?php __('lblChoose'); ?> --</option>
						<?php
						foreach ($tpl['country_arr'] as $country)
						{
							?><option value="<?php echo $country['id']; ?>"<?php echo isset($tpl['arr']['c_country']) && $tpl['arr']['c_country'] == $country['id'] ? ' selected="selected"' : NULL; ?>><?php echo stripslashes($country['name']); ?></option><?php
						}
						?>
					</select>
				</span>
			</p>
			<?php endif; ?>
			<?php if (in_array($tpl['option_arr']['o_bf_state'], array(2,3))) : ?>
			<p>
				<label class="title"><?php __('lblReservationState'); ?></label>
				<span class="inline_block">
					<input type="text" name="c_state" id="c_state" class="pj-form-field w200" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['c_state'])); ?>" />
				</span>
			</p>
			<?php endif; ?>
			<?php if (in_array($tpl['option_arr']['o_bf_zip'], array(2,3))) : ?>
			<p>
				<label class="title"><?php __('lblReservationZip'); ?></label>
				<span class="inline_block">
					<input type="text" name="c_zip" id="c_zip" class="pj-form-field w150" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['c_zip'])); ?>" />
				</span>
			</p>
			<?php endif; ?>
			<?php if (in_array($tpl['option_arr']['o_bf_notes'], array(2,3))) : ?>
			<p>
				<label class="title"><?php __('lblReservationNotes'); ?></label>
				<textarea name="c_notes" id="c_notes" class="pj-form-field w500 h80"><?php echo stripslashes($tpl['arr']['c_notes']); ?></textarea>
			</p>
			<?php endif; ?>
			<div class="float_left w300">
				<p>
					<label class="title"><?php __('lblIp'); ?></label>
					<span class="left"><?php echo $tpl['arr']['ip']; ?></span>
				</p>
			</div>
			<div class="float_right w350">
				<p>
					<label class="title" style="width: 170px"><?php __('lblReservationCreated'); ?></label>
					<span class="left"><?php echo date($tpl['option_arr']['o_date_format'], strtotime($tpl['arr']['created'])); ?>, <?php echo date("H:i:s", strtotime($tpl['arr']['created'])); ?></span>
				</p>
			</div>
			<br class="clear_both" />
			<div class="float_left w350">
				<p>
					<label class="title">&nbsp;</label>
					<input type="submit" value="<?php __('btnSave', false, true); ?>" class="pj-button" />
					<input type="button" value="<?php __('btnCancel'); ?>" class="pj-button" onclick="window.location.href='<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjAdminReservations&action=pjActionIndex';" />
				</p>
			</div>
			<div class="float_right w350">
				<p>
					<a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="pj-button inline_block btnResend"><?php __('lblReservationResend'); ?></a>
				</p>
			</div>
		</fieldset>
	</form>
	
	<div id="dialogMessage" title="<?php __('ResConfirmationTitle'); ?>" style="display: none">
		<p><label><input type="checkbox" value="1" name="dialog_confirm" id="dialog_confirm" /> <?php __('ResConfirmationText'); ?></label></p><br />
		<p class="b10"><input type="text" class="pj-form-field pj-form-field-readonly b10" style="width: 470px" readonly="readonly" /></p>
		<p><textarea class="pj-form-field pj-form-field-readonly" style="width: 470px; height: 310px; resize: none" readonly="readonly"></textarea></p>
	</div>
	
	<div id="dialogResend" title="<?php __('lblReservationResend'); ?>" style="display: none">
		<p style="display:<?php echo count($tpl['locale_arr']) > 1 ? 'block' : 'none';?>;">
			<label>
				<select id="resend_language" name="locale_id" class="pj-form-field w200">
					<?php
					foreach ($tpl['locale_arr'] as $locale)
					{
						?><option value="<?php echo $locale['id']; ?>"><?php echo pjSanitize::html($locale['title']); ?></option><?php
					} 
					?>
				</select>
			</label>
		</p>
		<br />
		<p class="b10"><input type="text" class="pj-form-field b10" style="width: 470px" /></p>
		<p><textarea class="pj-form-field" style="width: 470px; height: 310px; resize: none"></textarea></p>
	</div>
	
	<div id="dialogCalculate" title="<?php __('reservation_calc_title'); ?>" style="display: none"><?php __('reservation_calc_body'); ?></div>
	
	<script type="text/javascript">
	var pjGrid = pjGrid || {};
	pjGrid.jqDateFormat = "<?php echo pjUtil::jqDateFormat($tpl['option_arr']['o_date_format']); ?>";
	pjGrid.jsDateFormat = "<?php echo pjUtil::jsDateFormat($tpl['option_arr']['o_date_format']); ?>";
	var myLabel = myLabel || {};
	
	myLabel.dateRangeValidation = "<?php __('lblReservationDateRangeValidation', false, true); ?>";
	myLabel.btnContinue = "<?php __('btnContinue', false, true); ?>";
	myLabel.btnCancel = "<?php __('btnCancel', false, true); ?>";
	myLabel.btnSend = "<?php __('btnSend', false, true); ?>";
	myLabel.empty_date = "<?php __('gridEmptyDate', false, true); ?>";
	myLabel.invalid_date = "<?php __('gridInvalidDate', false, true); ?>";
	myLabel.empty_datetime = "<?php __('gridEmptyDatetime', false, true); ?>";
	myLabel.invalid_datetime = "<?php __('gridInvalidDatetime', false, true); ?>";
	myLabel.duplicatedUniqueID = "<?php __('lblDuplicatedUniqueID'); ?>";
	</script>
	<?php
}
?>