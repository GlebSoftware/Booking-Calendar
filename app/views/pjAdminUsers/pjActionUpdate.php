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
	
	$jquery_validation = __('jquery_validation', true);
	?>
	
	<?php
	pjUtil::printNotice(@$titles['AU11'], @$bodies['AU11']);
	?>
	
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminUsers&amp;action=pjActionUpdate" method="post" id="frmUpdateUser" class="form pj-form">
		<input type="hidden" name="user_update" value="1" />
		<input type="hidden" name="id" value="<?php echo $tpl['arr']['id']; ?>" />
		<p>
			<label class="title"><?php __('lblRole'); ?></label>
			<span class="inline_block">
				<select name="role_id" id="role_id" class="pj-form-field required" data-msg-required="<?php echo $jquery_validation['required'];?>">
					<option value="">-- <?php __('lblChoose'); ?>--</option>
				<?php
				foreach ($tpl['role_arr'] as $v)
				{
					?><option value="<?php echo $v['id']; ?>"<?php echo $tpl['arr']['role_id'] == $v['id'] ? ' selected="selected"' : NULL; ?>><?php echo stripslashes($v['role']); ?></option><?php
				}
				?>
				</select>
				<a href="#" class="pj-form-langbar-tip listing-tip" title="<?php __('lblUserRoleTip'); ?>"></a>
			</span>
		</p>
		<p>
			<label class="title"><?php __('email'); ?></label>
			<span class="pj-form-field-custom pj-form-field-custom-before">
				<span class="pj-form-field-before"><abbr class="pj-form-field-icon-email"></abbr></span>
				<input type="text" name="email" id="email" class="pj-form-field required email w200" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['email'])); ?>" data-msg-required="<?php echo $jquery_validation['required'];?>" data-msg-email="<?php echo $jquery_validation['email'];?>"/>
			</span>
		</p>
		<p>
			<label class="title"><?php __('pass'); ?></label>
			<span class="pj-form-field-custom pj-form-field-custom-before">
				<span class="pj-form-field-before"><abbr class="pj-form-field-icon-password"></abbr></span>
				<input type="text" name="password" id="password" class="pj-form-field required w200" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['password'])); ?>" data-msg-required="<?php echo $jquery_validation['required'];?>"/>
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblName'); ?></label>
			<span class="inline_block">
				<input type="text" name="name" id="name" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['name'])); ?>" class="pj-form-field w250 required" data-msg-required="<?php echo $jquery_validation['required'];?>"/>
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblPhone'); ?></label>
			<span class="pj-form-field-custom pj-form-field-custom-before">
				<span class="pj-form-field-before"><abbr class="pj-form-field-icon-phone"></abbr></span>
				<input type="text" name="phone" id="phone" class="pj-form-field w200" value="<?php echo htmlspecialchars(stripslashes($tpl['arr']['phone'])); ?>" />
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblNotifyEmail'); ?></label>
			<span id="boxEmail">
				<select name="notify_email[]" multiple="multiple" size="5">
				<?php
				foreach (__('notify_email', true) as $k => $v)
				{
					?><option value="<?php echo $k; ?>"<?php echo in_array($k, $tpl['email_arr']) ? ' selected="selected"' : NULL; ?>><?php echo $v; ?></option><?php
				}
				?>
				</select>
			</span>
			<a href="#" class="pj-form-langbar-tip listing-tip" title="<?php __('lblUserEmailTip'); ?>"></a>
		</p>
		<p>
			<label class="title"><?php __('lblNotifySms'); ?></label>
			<span id="boxSms">
				<select name="notify_sms[]" multiple="multiple" size="5">
				<?php
				foreach (__('notify_email', true) as $k => $v)
				{
					?><option value="<?php echo $k; ?>"<?php echo in_array($k, $tpl['sms_arr']) ? ' selected="selected"' : NULL; ?>><?php echo $v; ?></option><?php
				}
				?>
				</select>
			</span>
			<a href="#" class="pj-form-langbar-tip listing-tip" title="<?php __('lblUserSmsTip'); ?>"></a>
		</p>
		<?php
		if ($controller->getUserId() != $tpl['arr']['id'])
		{
			?>
			<p>
				<label class="title"><?php __('lblStatus'); ?></label>
				<span class="inline_block">
					<select name="status" id="status" class="pj-form-field required" data-msg-required="<?php echo $jquery_validation['required'];?>">
						<option value="">-- <?php __('lblChoose'); ?>--</option>
						<?php
						foreach (__('u_statarr', true) as $k => $v)
						{
							?><option value="<?php echo $k; ?>"<?php echo $k == $tpl['arr']['status'] ? ' selected="selected"' : NULL; ?>><?php echo $v; ?></option><?php
						}
						?>
					</select>
				</span>
			</p>
			<?php
		}
		if ($tpl['arr']['role_id'] == 3)
		{
			?>
			<p><label class="title"><?php __('lblIsActive'); ?></label>
				<select name="is_active" id="is_active" class="pj-form-field required" data-msg-required="<?php echo $jquery_validation['required'];?>">
					<option value="">-- <?php __('lblChoose'); ?>--</option>
					<?php
					foreach (__('u_statarr', true) as $k => $v)
					{
						?><option value="<?php echo $k; ?>"<?php echo $k == $tpl['arr']['is_active'] ? ' selected="selected"' : NULL; ?>><?php echo $v; ?></option><?php
					}
					?>
				</select>
			</p>
			<?php
		}
		?>
		<p>
			<label class="title"><?php __('lblUserCreated'); ?></label>
			<span class="left"><?php echo date($tpl['option_arr']['o_date_format'], strtotime($tpl['arr']['created'])); ?>, <?php echo date("H:i", strtotime($tpl['arr']['created'])); ?></span>
		</p>
		<p>
			<label class="title"><?php __('lblIp'); ?></label>
			<span class="left"><?php echo $tpl['arr']['ip']; ?></span>
		</p>
		<p>
			<label class="title">&nbsp;</label>
			<input type="submit" value="<?php __('btnSave'); ?>" class="pj-button" />
			<input type="button" value="<?php __('btnCancel'); ?>" class="pj-button" onclick="window.location.href='<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjAdminUsers&action=pjActionIndex';" />
		</p>
	</form>
	<script type="text/javascript">
	var myLabel = myLabel || {};
	myLabel.emailValidation = "<?php __('lblEmailValidationUnique'); ?>";
	</script>
	<?php
}
?>