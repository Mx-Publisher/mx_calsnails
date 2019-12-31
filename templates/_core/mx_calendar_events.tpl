<table width="100%" cellpadding="0" cellspacing="1" border="0" class="forumline" style="border-top:none;">
	<tr>
		<td width="100%" class="row1">
			<!-- BEGIN switch_use_vsize_on -->
			<div class="calsnailslist" style="overflow-y:auto; overflow-x:hidden;height:{BLOCK_VSIZE}px; width:100%;">
			<!-- END switch_use_vsize_on -->
			<table width="100%" cellpadding="2" cellspacing="1" border="0">

				<tr>
					<td class="row3" align="left" valign="middle" height="15">
						<span class="genmed"><b>{EVENTS_LABEL}</b></span>
					</td>
				</tr>

				<!-- BEGIN no_events -->
				<tr>
					<td class="row1" align="center"><span class="genmed">&nbsp;<br />{no_events.NO_EVENTS}</span></td>
				</tr>
				<!-- END no_events -->

				<!-- BEGIN event_row -->

				<!-- BEGIN event_row_switch_day -->
				<tr>
					<td class="row2" valign="middle" height="15">
						<span class="gensmall"><a href="{event_row.U_INI_DATE}" ><b>{event_row.INI_DATE}</b></a>

				<!-- BEGIN event_row_switch_endday -->
						<br />&raquo;&nbsp;<a href="{event_row.U_END_DATE}" ><b>{event_row.END_DATE}</b></a>
				<!-- END event_row_switch_endday -->

				<!-- END event_row_switch_day -->

				<!-- BEGIN event_row_switch_day -->
					</span></td>
				</tr>
				<!-- END event_row_switch_day -->
				<tr>
					<td class="{event_row.ROW_CLASS}">
						<!-- BEGIN event_row_switch_time -->
						<!--
						<span class="genmed"><u>{event_row.INI_TIME}</u></span><br />
						-->
						<!-- END event_row_switch_time -->
						<span class="gensmall"><b>{event_row.SUBJECT}</b></span><br />
						<span class="gensmall">{event_row.DESC}</span>
						<!--
						<span class="gensmall">{event_row.AUTHOR}</span><br />
						-->
						<span class="gensmall"><br /><a href="{event_row.U_MORE_INFO}" class="gensmall">{L_MORE_INFO}</a></span>
					</td>
				</tr>
				<!-- END event_row -->
			</table>

			<!-- BEGIN switch_use_vsize_on -->
			</div>
			<!-- END switch_use_vsize_on -->
		</td>
	</tr>
</table>