<script language="javascript" type="text/javascript">
<!--
var cssTextHover, cssTextLink;
function swc(id,fon) {
   if (document.all) {
     var d=document.all[id];
     for(var i=0;i<d.length;i++){
	// go through everything of id "cal_id###"
        d[i].style.cssText=(fon?cssTextHover:cssTextLink);
     //set the style accordingly
     }
   }
}

function setup() {
   if (document.all) {
     dd=document.styleSheets;
     for(var j=0; j<dd.length; j++) {
	var ss=document.styleSheets[j].rules;
	     for(var i=0;i<ss.length;i++){
	     var rr=ss[i];
	     strSelector=rr.selectorText;
	     if(strSelector=="A:hover") cssTextHover=rr.style.cssText;
	     else if (strSelector=="A:link") cssTextLink=rr.style.cssText;
	}
     }
   }
 }
setup();
//-->
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="forumline" style="border-top:none;">
	<tr>
		<td>

			<!-- BEGIN switch_show -->
			<table width="100%" cellpadding="2" cellspacing="1" border="0" align="center">
				<tr>
					<td align="left">{PHPBBHEADER}<span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> -&gt;
					<a href="{U_CAL_HOME}" class="nav">{CALENDAR}</a></span></td>
					<td align=right class=genmed>{CAL_VERSION}</td>
				</tr>
			</table>
			<!-- END switch_show -->

			<table width="100%" cellpadding="2" cellspacing="1" border="0" >
				<tr>
					<td class="cat" align="center" colspan="7"><span class="gen">&nbsp;{CAL_MONTH}&nbsp;{CAL_YEAR}</span></td>
				</tr>
				<tr>
					<td class="row3" width="14%" align="center"><b><span class="genmed">{DAY_HEAD_1}</span></b></td>
					<td class="row3" width="14%" align="center"><b><span class="genmed">{DAY_HEAD_2}</span></b></td>
					<td class="row3" width="14%" align="center"><b><span class="genmed">{DAY_HEAD_3}</span></b></td>
					<td class="row3" width="14%" align="center"><b><span class="genmed">{DAY_HEAD_4}</span></b></td>
					<td class="row3" width="14%" align="center"><b><span class="genmed">{DAY_HEAD_5}</span></b></td>
					<td class="row3" width="14%" align="center"><b><span class="genmed">{DAY_HEAD_6}</span></b></td>
					<td class="row3" width="14%" align="center"><b><span class="genmed">{DAY_HEAD_7}</span></b></td>
				</tr>
				<tr>
					<!-- BEGIN no_day -->
					<td {no_day.S_CELL}>&nbsp;</td>
					<!-- END no_day -->
					<!-- BEGIN daycell -->
					<td valign="top" {daycell.S_CELL}>
						<table width="100%" cellspacing="0" cellpadding="2" border="0">
							<tr><td height="15" {daycell.S_HEAD}><a href="{daycell.U_DAY}" class="topictitle">{daycell.NUM_DAY}</a></td></tr>
							<tr><td height="60" valign="top" {daycell.S_DETAILS}><div style="overflow:auto; height:50px;">{daycell.DAY_EVENT_LIST}</div></td></tr>
						</table>
					</td>
					{daycell.WEEK_ROW}
					<!-- END daycell -->
				</tr>
				<tr>
					<td align="center" class="cat" colspan="7">
						<table border="0" cellspacing="0" cellpadding="0">
							<tr>
								{BUTTON_PREV}{BUTTON_ADD}{BUTTON_VALIDATE}{BUTTON_NEXT}
							</tr>
							<tr>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>