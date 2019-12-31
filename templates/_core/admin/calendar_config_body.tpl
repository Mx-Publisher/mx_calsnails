
<h1>{L_CONFIGURATION_TITLE}</h1>

<p>{L_CONFIGURATION_EXPLAIN}</p>

<form action="{S_CONFIG_ACTION}" method="post">
  <table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
    <tr>
      <th class="thHead" colspan="2">{L_GENERAL_SETTINGS}</th>
    </tr>
    <tr>
      <td class="row1">{L_WEEK_START}</td>
      <td class="row2">{WEEK_START_SELECT}</td>
    </tr>
    <tr>
      <td class="row1"><p>{L_SUBJECT_LENGTH}<br>
          <span class="gensmall">{L_SUBJECT_LENGTH_EXPLAIN}</span> </p></td>
      <td class="row2"><input type="text" maxlength="5" size="5" name="subject_length" value="{SUBJECT_LENGTH}" /></td>
    </tr>
    <tr>
      <td class="row1">{L_ALLOW_ANON_DEFAULT}</td>
      <td class="row2">{S_ALLOW_ANON_DEFAULT}</td>
    </tr>
    <tr>
      <td class="row1">{L_ALLOW_USER_DEFAULT}</td>
      <td class="row2">{S_ALLOW_USER_DEFAULT}</td>
    </tr>
	<tr>
		<td class="row1" width="50%">{L_MOD_GROUP}<br /><span class="gensmall">{L_MOD_GROUP_EXPLAIN}</span></td>
		<td class="row2" width="50%">{MOD_GROUP}</td>
	</tr>
    <tr>
      <td class="row1">{L_ALLOW_OLD}<br>
        <span class="gensmall">{L_ALLOW_OLD_EXPLAIN}</span> </td>
      <td class="row2"><input type="radio" name="allow_old" value="1" {S_ALLOW_OLD_YES} />
        {L_YES}&nbsp;&nbsp; <input type="radio" name="allow_old" value="0" {S_ALLOW_OLD_NO} />
        {L_NO}</td>
    </tr>
    <tr>
      <td class="row1">{L_SHOW_HEADERS}</td>
      <td class="row2"><input type="radio" name="show_headers" value="1" {S_SHOW_HEADERS_YES} />
        {L_YES}&nbsp;&nbsp; <input type="radio" name="show_headers" value="0" {S_SHOW_HEADERS_NO} />
        {L_NO}</td>
    </tr>
    <tr>
      <td class="row1">{L_DATE_FORMAT}<br /> <span class="gensmall">{L_DATE_FORMAT_EXPLAIN}</span></td>
      <td class="row2"><input type="text" name="cal_dateformat" value="{CAL_DATEFORMAT}" /></td>
    </tr>
    <tr>
      <td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS} <input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />
        &nbsp;&nbsp; <input type="reset" value="{L_RESET}" class="liteoption" />
      </td>
    </tr>
  </table>
</form>