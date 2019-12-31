<table width="{BLOCK_SIZE}" border="0" cellspacing="1" cellpadding="0" class="forumline" style="border-top:none;">
	<tr>
		<td class="row1">

			<!-- BEGIN switch_show -->
			<table width="100%" cellspacing="0" cellpadding="2" border="0" align="center">
				<tr>
					<td align="left">{PHPBBHEADER}<span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> -&gt;
					<a href="{U_CAL_HOME}" class="nav">{CALENDAR}</a></span></td>
					<td align=right class=genmed>{CAL_VERSION}</td>
				</tr>
			</table>
			<!-- END switch_show -->

			<table width="100%" cellpadding="2" cellspacing="0" border="0">
				<tr>
					<td class="cat">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								{BUTTON_PREV}
								<td align="center">
									<span><b>&nbsp;{CAL_DAY}&nbsp;&nbsp;{CAL_MONTH}&nbsp;&nbsp;{CAL_YEAR}</b></span>
								</td>
								{BUTTON_NEXT}
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellpadding="1" cellspacing="0" border="0">
							<tr>
								<td width="45%" class="row3" NOWRAP><span class="genmed"><b>{SUBJECT}</b></span></td>
								<td width="20%" class="row3" NOWRAP><span class="genmed"><b>{DATE}</b></span></td>
								<td width="20%" class="row3" NOWRAP><span class="genmed"><b>{END_DATE}</b></span></td>
								<td width="15%" class="row3" NOWRAP><span class="genmed"><b>{AUTHOR}</b></span></td>
							</tr>
							<!-- BEGIN no_events -->
							<tr>
								<td colspan="4"><span class="gen"><br />{no_events.NO_EVENTS}</span></td>
							</tr>
							<!-- END no_events -->
							<!-- BEGIN event_row -->
							<tr>
								<td class="row1"><span class="genmed"><b>{event_row.SUBJECT}</b></span></td>
								<td class="row1" NOWRAP><span class="genmed">{event_row.DATE}</span></td>
								<td class="row1" NOWRAP><span class="genmed">{event_row.END_DATE}</span></td>
								<td class="row1" NOWRAP><span class="genmed">{event_row.AUTHOR}</span></td>
							</tr>
							<tr>
								<td colspan="4" class="row1"><span class="genmed">{event_row.DESC}</td>
							</tr>
							<tr>
								<td colspan="4" class="row1" align="right">{event_row.BUTTON_MOD}&nbsp;{event_row.BUTTON_DEL}</td>
							</tr>
							<tr>
								<td colspan="4"><span class="genmed">&nbsp;</span></td>
							</tr>
							<!-- END event_row -->
						</table>
					</td>
				</tr>
			</table>

			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td class="cat" align="center">
						<table border="0" cellspacing="0" cellpadding="5">
							<tr>
								<td align="center">
								{BUTTON_ADD}
								{BUTTON_VAL}
								{BUTTON_HOME}
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>

		</td>
	</tr>
</table>