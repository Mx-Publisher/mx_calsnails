<table width="{BLOCK_SIZE}" cellpadding="0" cellspacing="1" border="0" class="forumline" style="border-top:none;">
	<tr>
		<td class="cat" align="center" valign="middle" height="24">
			<span class="gen"><a href="{U_CAL_MONTH}" class="gen"><b>{CAL_MONTH}&nbsp;{CAL_YEAR}</b></a></span>
		</td>
	</tr>
	<!-- BEGIN info -->
	<tr>
		<td class="row1" align="center" valign="middle" height="24">
			<span class="gen">This block is not correctly configured. Use the blockCP to define its target calsnails block.</span>
		</td>
	</tr>
	<!-- END info -->
	<tr>
		<td>
			<table width="100%" cellpadding="1" cellspacing="0" border="0">
				<tr>
					<td width="14%" class="row3" align="center"><span class="genmed">{DAY_HEAD_1}</span></td>
					<td width="14%" class="row3" align="center"><span class="genmed">{DAY_HEAD_2}</span></td>
					<td width="14%" class="row3" align="center"><span class="genmed">{DAY_HEAD_3}</span></td>
					<td width="14%" class="row3" align="center"><span class="genmed">{DAY_HEAD_4}</span></td>
					<td width="14%" class="row3" align="center"><span class="genmed">{DAY_HEAD_5}</span></td>
					<td width="14%" class="row3" align="center"><span class="genmed">{DAY_HEAD_6}</span></td>
					<td width="14%" class="row3" align="center"><span class="genmed">{DAY_HEAD_7}</span></td>
				</tr>
			</table>
			<table width="100%" cellpadding="1" cellspacing="0" border="0" style="border-top:0px;">
				<tr>
					<!-- BEGIN daycell -->
					<td align="center" {daycell.S_HEAD}>
						<span class="genmed">{daycell.NUM_DAY}</span>
					</td>
					{daycell.WEEK_ROW}
					<!-- END daycell -->
				</tr>
			</table>
		</td>
	</tr>
</table>