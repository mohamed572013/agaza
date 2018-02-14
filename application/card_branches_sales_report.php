<?php include("../includes/config.php"); ?>
<script type="text/javascript" src="includes/dtree.js"></script>
<link rel="StyleSheet" href="css/css.css" type="text/css" />

<div id='calendar' style='display:inline; position:absolute; z-index:999999px'></div>

<?php
//***************************************Add*****************************************
//function form6_res_report()
//{
//error_reporting(E_ALL);
//include("../includes/config.php");
	include("../lang/arabic.php");
	$page = $_GET['page'];
	include("card_functions.php");
	include("tcpdf/examples/test1.php");
	include("tcpdf/examples/test2.php");
	$branch_id_search = \implode(",", array_filter($_GET['branch_id_search']));
//	echo $branch_id_search;
	$prog_id_search = $_GET['prog_id_search'];
	$hotel_id_search = $_GET['hotel_id_search'];
	$employee_id_search = $_GET['employee_id_search'];
	$creation_date_from = $_GET['creation_date_from'];
	$creation_date_to = $_GET['creation_date_to'];
	$trip_datefrom = $_GET['trip_datefrom'];
	$trip_dateto = $_GET['trip_dateto'];
	$transport_type_types_id_search = $_GET['transport_type_types_id_search'];
	$operational_type_id_search = $_GET['operational_type_id_search'];
	$rate_search = $_GET['rate_search'];
	//print_r($_REQUEST);

	$year = $_GET['year'];
	$res = mysql_query("SELECT
employees.branch_id,users.*
FROM
users
Inner Join employees ON users.employee_id = employees.id WHERE users.id='$_SESSION[login_user_id]'");
	$row = mysql_fetch_array($res);
	$open_reports = $row['open_reports'];
	if ($open_reports == 1)
		$disallbranch = "";
	else {
		$branch_id_search = $row['branch_id'];
		$disallbranch = "disabled";
	}
	function select_more_branch_name($branch_id){
		$branch_id = \explode(",", $branch_id);
		$sql = "SELECT id,name FROM our_branchs ";
		?>
		<table border="1" class="mtable" width="1000" align="center" dir="rtl" cellpadding="2" cellspacing="0">
			<tbody>
				<tr>

					<?php
					$index = 0;
					if ($result = mysql_query($sql)) {
						while ($row = mysql_fetch_array($result)) {
							$index++;
							$id = $row['id'];
							$name = $row['name'];
							if ($index % 5 == 1) {
								echo '<tr>';
							}
							if (\in_array($id, $branch_id)) {
								$b_val = $id;
								$checked = "checked";
							} else {
								$b_val = "";
								$checked = "";
							}
							echo"	<td>
						<input type=\"checkbox\" name=\"branch_id_search[]\" value=\"$b_val\" $checked onchange=\"if (this.checked) this.value = '$id'; else this.value = '';\"> $name
					</td>";
							if ($index % 5 == 0) {
								echo '</tr>';
							}
						}
					}
					?>

				</tr>
			</tbody>
		</table>
		<?php
	}
?>
<table align="center">
    <tr><td>
            <form name="mform" action="">
				<table  class="n1"  cellpadding="5" dir="<?php echo $lang['dir']; ?>" align="center" >

					<tr>
						<td valign="top"  >


							<span class="title1" ><?php echo $lang['card_sales_report']; ?></span>

							<br /><br />

							<table dir="<?php echo $lang['dir'] ?>" cellspacing="3">
								<tr>
									<td>
										<?php echo $lang['year']; ?>
									</td>
									<td>
										<?php selectYear($year); ?>
									</td>
								</tr>
								<?php
									if ($_REQUEST[action] == "yearSelected" || $_REQUEST[action] == "search") {
										?>
										<tr>
											<td colspan="6"><br/></td>
										</tr>
										<tr>
											<td>
												<?php echo $lang['bransh']; ?>
											</td>
											<td colspan="5">
												<?php select_more_branch_name($branch_id_search); ?>

											</td>
										</tr>
										<tr>
											<td colspan="6"><br/></td>
										</tr>
										<tr>
											<td>
												<?php echo $lang['passport_code']; ?>
											</td>
											<td>
												<?php selectProgramsForReportCardcanceledFilterYear($prog_id_search, $year); ?>
											</td>

											<td>
												<?php echo $lang['passport_hotel_name']; ?>
											</td>
											<td>
												<?php select_hotel_name('hotel_id_search', $hotel_id_search); ?>
											</td>



											<td>
												<?php echo $lang['employee']; ?>
											</td>

											<td>
												<?php select_employee_name('employee_id_search', $employee_id_search); ?>
											</td>

										</tr>
										<tr>
											<td>
												<?php echo $lang['resereve_date']; ?>
											</td>
											<td><input name="creation_date_from" id="creation_date_fromid" value="<?php echo $creation_date_from; ?>" size='10'/>
												<a href="javascript:void(0)"
												   onclick="getcalander(document.mform.creation_date_from);return false;">
													<img class="PopcalTrigger" align="absmiddle" src="images/icons/calendar.gif" border="0" alt=""/>
												</a>
											</td>
											<td>
												<?php echo $lang['form8_date_to']; ?>
											</td>
											<td><input name="creation_date_to" id="creation_date_toid" value="<?php echo $creation_date_to; ?>" size='10'/>
												<a href="javascript:void(0)"
												   onclick="getcalander(document.mform.creation_date_to);return false;">
													<img class="PopcalTrigger" align="absmiddle" src="images/icons/calendar.gif" border="0" alt=""/>
												</a>
											</td>
											<td>
												<?php echo $lang['trip_date']; ?>
											</td>
											<td><input name="trip_datefrom" id="trip_datefromid" value="<?php echo $trip_datefrom; ?>" size='10'/>
												<a href="javascript:void(0)"
												   onclick="getcalander(document.mform.trip_datefrom);return false;">
													<img class="PopcalTrigger" align="absmiddle" src="images/icons/calendar.gif" border="0" alt=""/>
												</a>
											</td>
											<td>
												<?php echo $lang['form8_date_to']; ?>
											</td>
											<td><input name="trip_dateto" id="trip_datetoid" value="<?php echo $trip_dateto; ?>" size='10'/>
												<a href="javascript:void(0)"
												   onclick="getcalander(document.mform.trip_dateto);return false;">
													<img class="PopcalTrigger" align="absmiddle" src="images/icons/calendar.gif" border="0" alt=""/>
												</a>
											</td>
										</tr>

										<tr>


											<td>
												<input type="hidden" name="selectOperation" value="res_report"/>
												<input type="hidden" name="search" value="search"/>
												<input type="hidden" name="prog_id" value="<?php echo $prog_id; ?>"/>

												<input type="button" value="<?php echo $lang['search'] ?>" onclick="
															showCustomer('search', '<?php echo $page; ?>', '', this.form);"/>
											</td>
										</tr>
										<?php
									}
								?>
							</table>
							</form>
						</td></tr>
					<?php
						if ($_REQUEST[action] == "search") {



							$where = '';
							$inner = '';

							if (isset($prog_id_search) and $prog_id_search != '') {
								$where = $where . " AND programs.id IN ($prog_id_search)";
							}
							if (isset($hotel_id_search) and $hotel_id_search != '') {

								$inner.="Inner Join prog_city ON programs.id = prog_city.prog_id ";
								$where = $where . " AND prog_city.hotel_id ='$hotel_id_search'";
							}



							if (isset($employee_id_search) && $employee_id_search != '') {


								$inner.="Inner Join card_log ON card_log.card_id = card.id
             Inner Join users ON card_log.user_id = users.id
             Inner Join employees ON users.employee_id = employees.id
             Inner Join our_branchs ON employees.branch_id = our_branchs.id";
							}

							if (isset($branch_id_search) and $branch_id_search != '') {

								$where = $where . " AND card.branch_id IN ($branch_id_search) ";
							}

							if (isset($employee_id_search) and $employee_id_search != '') {

								$where = $where . " AND employees.id='$employee_id_search' AND card_log.modification_type_id = '14'";
							}




							if (isset($creation_date_from) and $creation_date_from != '') {

								$where = $where . "AND (date(card.creation_date)>'$creation_date_from' or date(card.creation_date)='$creation_date_from')";
							}

							if (isset($creation_date_to) and $creation_date_to != '') {
								$where = $where . "AND (date(card.creation_date)<'$creation_date_to' or date(card.creation_date)='$creation_date_to')";
							}

							if ((isset($trip_datefrom) and $trip_datefrom != '' ) || (isset($trip_dateto) and $trip_dateto != '' )) {

								$where = $where . " AND (card.rate>'$trip_datefrom' or card.rate='$trip_datefrom')";
							}

							if (isset($trip_dateto) and $trip_dateto != '') {
								$where = $where . " AND (card.rate<'$trip_dateto' or card.rate='$trip_dateto')";
							}

							if ($_GET['search'] == "search") {
								echo"<div align=\"center\"><a href='#' onclick=\"printdiv('print');\">Click here for print</a></div>";
							}
							?>
							<?php
//show
							$font_size = 2;
//***********************************************
							$sql = "SELECT DISTINCT
card.id as card_num,
programs.name AS prog_name,
card.operation ,
card.confirm,
card.group_status ,
card.rate AS prog_trip_rate,
card.creation_date as creation_date,
programs.id as prog_id
FROM programs
Inner Join card ON card.prog_id = programs.id
$inner
where card.cancel='0'AND programs.year='$year'   $where
	
 order by card.branch_id 
";
							$sql_prog_name = "SELECT
concat('TJ',programs.name) as name
FROM programs
where programs.id IN ($prog_id_search)";

							if ($result_prog_name = mysql_query($sql_prog_name)) {
								$row11 = mysql_fetch_array($result_prog_name);
								$prog_id_search_name = $row11['name'];
							}
							else {
								$prog_id_search_name = $lang[all];
							}

							$sql_prog_name = "SELECT name FROM htl_crs where id='$hotel_id_search' ";
//echo $sql_prog_name;
							if ($result_hotel_name = mysql_query($sql_prog_name)) {
								$row12 = mysql_fetch_array($result_hotel_name);
								$hotel_id_search_name = $row12['name'];
							}
							if($hotel_id_search_name==""){
								$hotel_id_search_name = $lang[all];
							}
							
								 


							$sql_branch_name = "SELECT name FROM our_branchs where id IN ($branch_id_search) ";
//echo $sql_prog_name;
							if ($result_branch_name = mysql_query($sql_branch_name)) {
								$j_index = 0;
								while ($row13 = mysql_fetch_array($result_branch_name)) {
									$j_index++;
									if ($j_index > 1) {
										$branch_id_search_name.=" / ";
									}
									$branch_id_search_name .= $row13['name'];
								}
							} else {
								$branch_id_search_name = $lang[all];
							}

							$sql_employee_name = "SELECT employees.employee , our_branchs.name   "
									. "FROM employees"
									. " join our_branchs on our_branchs.id = employees.branch_id  "
									. " where employees.id='$employee_id_search' ";
//echo $sql_prog_name;
							if ($result_employee_name = mysql_query($sql_employee_name)) {
								$row14 = mysql_fetch_array($result_employee_name);
								$employee_id_search_name = $row14['employee'];
							}
							if($employee_id_search_name==""){
								$employee_id_search_name = $lang[all];
							}


							if ($result = mysql_query($sql)) {

								$pdf.= "
<table width=\"1000\" border=\"0\" class=\"mtable\" style=\"border-collapse: collapse \" align=\"center\" dir='" . $lang['dir'] . "' cellpadding=\"2\"  cellspacing=\"2\">
<tr><td colspan=\"16\" width=\"850\" align=\"center\" valign=\"top\">
<font size=\"5\">" . $lang['card_sales_report'] . "</font></td></tr>
<tr><td>&nbsp;</td></tr>

<tr>
<td align=\"right\" width=\"90\"><b><font size=\"$font_size\">$lang[passport_code]</font></b></td>
<td width=\"10\"><b>:</b></td>
<td align=\"right\" width=\"90\"><font size=\"$font_size\">$prog_id_search_name</font></td>

<td align=\"right\" width=\"150\"><b><font size=\"$font_size\">$lang[passport_hotel_name]</font></b></td>
<td width=\"10\"><b>:</b></td>
<td align=\"right\" width=\"300\"><font size=\"$font_size\">$hotel_id_search_name</font></td>
	
<td align=\"right\" width=\"80\"><b><font size=\"$font_size\">$lang[employee]</font></b></td>
<td width=\"10\"><b>:</b></td>
<td align=\"right\" width=\"100\"><font size=\"$font_size\">$employee_id_search_name</font></td>

</tr>
<tr>
<td align=\"right\" width=\"90\"><b><font size=\"$font_size\">$lang[bransh]</font></b></td>
<td width=\"10\"><b>:</b></td>
<td align=\"right\"  colspan='7'><font size=\"$font_size\">$branch_id_search_name</font></td>
</tr>
 
 <tr>

 

<td align=\"right\" width=\"200\"><b><font size=\"$font_size\">$lang[resereve_date]</font></b></td>
<td width=\"10\"><b>:</b></td>
<td align=\"right\" width=\"200\"><font size=\"$font_size\">$creation_date_from</font></td>

<td align=\"right\" width=\"150\"><b><font size=\"$font_size\">$lang[form8_date_to]</font></b></td>
<td width=\"10\"><b>:</b></td>
<td align=\"right\" width=\"200\"><font size=\"$font_size\">$creation_date_to</font></td>
 
</tr>
<tr>
<td align=\"right\" width=\"200\"><b><font size=\"$font_size\">$lang[trip_date]</font></b></td>
<td width=\"10\"><b>:</b></td>
<td align=\"right\" width=\"150\"><font size=\"$font_size\">$trip_datefrom</font></td>

<td align=\"right\" width=\"80\"><b><font size=\"$font_size\">$lang[form8_date_to]</font></b></td>
<td width=\"10\"><b>:</b></td>
<td align=\"right\" width=\"150\"><font size=\"$font_size\">$trip_dateto</font></td>
</font></td>

 
 
 </font></td>
</tr>";
								$pdf.= "
</br></br></br>";


								$pdf.= "<table border=\"1\" class=\"mtable\" width=\"1000\" align='center' dir='" . $lang['dir'] . "' cellpadding=\"2\"  cellspacing=0>";
								$pdf.= "
<tr>
	<th rowspan=\"2\" align=\"center\" width=\"20\" valign=\"middle\" height=\"20\"><font size=\"$font_size\"><b>" . $lang['serial'] . " </b></font></th>
	<th rowspan=\"2\" align=\"center\" width=\"250\" valign=\"middle\"><font size=\"$font_size\"><b>" . $lang['trav_ret_trip_date'] . "</b></font></th>
	<th rowspan=\"2\" align=\"center\" width=\"40\" valign=\"middle\"><font size=\"$font_size\"><b>" . $lang['passport_code'] . "</b></font></th>
        </font></th>
	<th rowspan=\"2\" align=\"center\" width=\"40\" valign=\"middle\"><font size=\"$font_size\"><b>" . $lang['card_number'] . "</b></font></th>
	<th rowspan=\"2\" align=\"center\" width=\"40\" valign=\"middle\"><font size=\"$font_size\"><b>" . $lang['branch'] . "</b></font></th>
	<th rowspan=\"2\" align=\"center\" width=\"80\" valign=\"middle\"><font size=\"$font_size\"><b>" . $lang['room_count'] . "</b></font></th>

        <th colspan=\"3\" align=\"center\" width=\"80\" valign=\"middle\"><font size=\"$font_size\"><b>" . $lang['numbers'] . "</b></font></th>

        <th rowspan=\"2\" align=\"center\" width=\"80\" valign=\"middle\"><font size=\"$font_size\"><b>" . $lang['card_sales_report_total_num'] . "</b></font></th>
	<th rowspan=\"2\" align=\"center\" width=\"80\" valign=\"middle\"><font size=\"$font_size\"><b>" . $lang['card_sales_report_total_value'] . "</b></font></th>
        <th rowspan=\"2\" align=\"center\" width=\"80\" valign=\"middle\"><font size=\"$font_size\"><b>" . $lang['card_sales_report_paid'] . "</b></font></th>
        <th rowspan=\"2\" align=\"center\" width=\"80\" valign=\"middle\"><font size=\"$font_size\"><b>" . $lang['card_sales_report_percent'] . "</b></font></th>
        <th rowspan=\"2\" align=\"center\" width=\"80\" valign=\"middle\"><font size=\"$font_size\"><b>" . $lang['card_sales_report_remaining'] . "</b></font></th>
        <th rowspan=\"2\" align=\"center\" width=\"80\" valign=\"middle\"><font size=\"$font_size\"><b>" . $lang['card_sales_report_percent'] . "</b></font></th>
        <th rowspan=\"2\" align=\"center\" width=\"150\" valign=\"middle\"><font size=\"$font_size\"><b>" . $lang['pm_employee_name'] . "</b></font></th>
 </tr>
<tr>
        <th align=\"center\" valign=\"middle\"><font size=\"$font_size\"><b>" . $lang['big'] . "</b></font></th>
	<th align=\"center\" valign=\"middle\"><font size=\"$font_size\"><b>" . $lang['child'] . "</b></font></th>
	<th align=\"center\" valign=\"middle\"><font size=\"$font_size\"><b>" . $lang['baby'] . "</b></font></th>
</tr>
";
								$i = 1;
								$total = 0;
								$total_person = 0;
								$total_big = 0;
								$total_child = 0;
								$total_baby = 0;
								$alltotalfee = 0;
								$totalfee_sum = 0;
								$remain_fees_sum = 0;

								while ($row = mysql_fetch_array($result)) {
									$prog_id = $row['prog_id'];
									$prog_name = $row['prog_name'];
									$card_num = $row['card_num'];
									$creation_date = $row['creation_date'];
									$prog_trip_rate = $row['prog_trip_rate'];
									$return_arrival_date = $row['return_arrival_date'];
									$operation = $row['operation'];
									$group_status = $row['group_status'];
									$confirm = $row['confirm'];

									$row_user_name = mysql_fetch_array(mysql_query("SELECT
												employees.employee ,our_branchs.name
												FROM
												users
												Inner Join employees ON users.employee_id = users.employee_id AND users.employee_id = employees.id
												Inner Join card_log ON card_log.user_id = users.id
												Inner Join our_branchs ON our_branchs.id = employees.branch_id
												WHERE
												card_log.modification_type_id =  '14' AND
												card_log.card_id =  '$card_num'"));
									$employee = $row_user_name['employee'];
									$our_branches_name = $row_user_name['name'];





									if ($confirm == 0)
										$color = "bgcolor=\"#CCCCCC\"";
									else
										$color = "";
									$pdf.= "<tr $color>
<td align=\"center\" ><font face=\"dejavusans\" size=\"$font_size\"> $i </font></td>
<td align=\"center\" align=\"center\" ><font face=\"dejavusans\" size=\"$font_size\">$prog_trip_rate </font></td>

<td align=\"center\" align=\"center\" ><font face=\"dejavusans\" size=\"$font_size\">
<form>
<input type=\"button\" onclick=\"showCustomer('pop','card_details','$prog_id',this.form)\" value='TJ$prog_name'/></font>
<input type=\"hidden\" name=\"rate\" value=\"$prog_trip_rate\" />
<input type=\"hidden\" name=\"prog_id\" value=\"$prog_id\" />
</form>
</td>
<td align=\"center\" align=\"center\" ><font face=\"dejavusans\" size=\"$font_size\">
<form>
<input type=\"button\" onclick=\"showCustomer('pop','card_info_detailed','$card_num',this.form)\" value='$card_num'/></font>
<input type=\"hidden\" name=\"card_num\" value=\"$card_num\" />
</form>
</td> 
<td align=\"center\"><font face=\"dejavusans\" size=\"$font_size\"> &nbsp;$our_branches_name </font></td>";

									if ($operation != 2) {
										$sql2 = "SELECT Count(`room_type`.`room_type`) ,ceil(count(paxes.id)/room_type.beds_number) as count, `room_type`.`room_type` as room_type
 FROM `paxes`
 Inner Join `card` ON `paxes`.`card_id` = `card`.`id`
 Inner Join `prog_prices` ON `paxes`.`prog_prices_id` = `prog_prices`.`id`
 Inner Join `room_type` ON `room_type`.`id` = `prog_prices`.`room_id`
 WHERE  paxes.card_id='$card_num'   and
paxes.cancel=0 and
prog_prices.room_person_type in
(select room_person_type.id from room_person_type where room_person_type.living_type!='1')
 GROUP BY `room_type`.`room_type`

";
//echo "=======>$sql2<============";
										if ($result2 = mysql_query($sql2)) {
											$j = 0;
											$c = 0;
											$pdf.= "<td align=\"center\" width=\"350\"> <font face=\"dejavusans\" size=\"$font_size\">&nbsp;";

											while ($row2 = mysql_fetch_array($result2)) {
												$j++;
												$c+=$count;
												$room_type = $row2['room_type'];
												$count = $row2['count'];
												$num_rows = mysql_num_rows($result2);
												$pdf.= "$count $room_type</br>";
											}
										}
									} else {
										if ($group_status == 1) {
											$sql5 = "
    SELECT room_type.id roomid , ceil(count(p.id)/room_type.beds_number) as count, `room_type`.`room_type` as room_type
FROM paxes p ,prog_prices ,room_type ,card
WHERE
prog_prices.id = p.prog_prices_id
and room_type.id = prog_prices.room_id
and p.card_id = card.id
and p.cancel=0
and card.group_status='1'
and card.cancel='0'
and card.id='$card_num'
group by room_type.beds_number , room_type.id order by room_type.id";
//echo "=======>$sql5<============";
											$result5 = mysql_query($sql5);
											$j = 0;
											$c = 0;
											$pdf.= "<td align=\"center\" > <font face=\"dejavusans\" size=\"$font_size\">&nbsp;";

											while ($row5 = mysql_fetch_array($result5)) {
												$j++;

												$c+=$count;
												$room_type = $row5['room_type'];
												$count = $row5['count'];

												$num_rows = mysql_num_rows($result5);

												$pdf.= "$count $room_type</br>";
											}
										} else {
											$sql6 = "
    select ifnull(sum(card_group_room.num),0) count  , `room_type`.`room_type` as room_type
from card_group_room,room_type,card where card_group_room.room_id = room_type.id and card_group_room.card_id = card.id
and  card.group_status = '0' and card.cancel='0' and card_group_room.card_id='$card_num' GROUP BY `room_type`.`room_type
   ";
//echo "=======>$sql6<============";
											$result6 = mysql_query($sql6);
											$j = 0;
											$c = 0;
											$pdf.= "<td align=\"center\" > <font face=\"dejavusans\" size=\"$font_size\">&nbsp;";

											while ($row6 = mysql_fetch_array($result6)) {
												$j++;

												$c+=$count;
												$room_type = $row6['room_type'];
												$count = $row6['count'];

												$num_rows = mysql_num_rows($result6);

												$pdf.= "$count $room_type</br>";
											}
										}
									}

									$sql3 = "SELECT
Count(`room_person_type`.`type`) as count_room_person_type,
`room_person_type`.`type` as 'type',card.id as card_id
FROM
`paxes`
Inner Join `card` ON `paxes`.`card_id` = `card`.`id`
Inner Join `prog_prices` ON `paxes`.`prog_prices_id` = `prog_prices`.`id`
LEFT Join `room_type` ON `room_type`.`id` = `prog_prices`.`room_id`
Inner Join `room_person_type` ON `prog_prices`.`room_person_type` = `room_person_type`.`id`
WHERE paxes.card_id='$card_num'  and card.cancel='0'
and paxes.cancel=0
GROUP BY
`room_person_type`.`type`
";
//echo $sql3;

									if ($result3 = mysql_query($sql3)) {
										$count_person = 0;
										$baby_count = $child_count = $big_count = 0;

										while ($row3 = mysql_fetch_array($result3)) {

											$count_room_person_type = $row3['count_room_person_type'];
											$card_id = $row3['card_id'];

											$type = $row3['type'];

											if ($type == 0) {
												$baby_count = $count_room_person_type;
												$total_baby+=$baby_count;
												$count_person+=$baby_count;
											} else if ($type == 1) {
												$child_count = $count_room_person_type;
												$total_child+=$child_count;
												$count_person+=$child_count;
											} else if ($type == 2) {
												$big_count = $count_room_person_type;
												$total_big+=$big_count;
												$count_person+=$big_count;
											}
										}
										$total_person+=$count_person;
									}

									$total = $big_count + $child_count + $baby_count;
//get total value
									$resfee = reservfee($card_num);
									$extrafee = extrafee($card_num);
									$finefee = finefee($card_num);
									$delfee = delfee($card_num);
									$totalfee = $extrafee + $resfee + $finefee - $delfee;
									$totalfee_sum+=$totalfee;
////get total amount of all receipts of this card
									$amount_num_paid = 0;
									$amount_num_return = 0;
									$sql_paid = "SELECT ifnull(sum(amount_LE),0) as amount_num FROM cash_supply WHERE card_id='$card_num' AND order_or_receipt='1' AND receit_type='0'"; //echo "$sql</br>";
									if ($result_paid = mysql_query($sql_paid)) {
										if ($row_paid = mysql_fetch_array($result_paid)) {
											$amount_num_paid = $row_paid['amount_num'];
										}
									}

									$sql_paid = "SELECT ifnull(sum(amount_LE),0) as amount_num FROM cash_supply WHERE card_id='$card_num' AND order_or_receipt='1' AND receit_type='1'"; //echo "$sql_paid</br>";
									if ($result_paid = mysql_query($sql_paid)) {
										if ($row_paid = mysql_fetch_array($result_paid)) {
											$amount_num_return = $row_paid['amount_num'];
										}
									}
									$amount_num_paid-=$amount_num_return;
									$remain_fees = $totalfee - $amount_num_paid;
									$remain_fees_sum+=$remain_fees;
									$amount_num_paid_sum+=$amount_num_paid;
//get percent of paid to total amount
									$percent_amount_paid = ($amount_num_paid / $totalfee) * 100;
//get percent of remain to total amount
									$percent_amount_remain = ($remain_fees / $totalfee) * 100;
									$percent_amount_remain_color = "#000";
									if ($percent_amount_remain < 50)
										$percent_amount_remain_color = "#FF0000";

									$pdf.= "
	<td align=\"center\">
        <font face=\"dejavusans\" size=\"$font_size\">
            <form action=\"\">
                    <input type=\"button\" onclick=\"showCustomer('pop','card_reservation_report_data','$card_num',this.form)\" value='$big_count'/></font>
                    <input type=\"hidden\" name=\"card_id\" value=\"$card_id\" />
                    <input type=\"hidden\" name=\"action\" value=\"big_pax_details\" />
                    <input type=\"hidden\" name=\"types\" value=\"2\" />
            </form>
        </font>
	 </td>
	<td align=\"center\">
            <font face=\"dejavusans\" size=\"$font_size\">
                <form action=\"\">
                    <input type=\"button\" onclick=\"showCustomer('pop','card_reservation_report_data','$card_num',this.form)\" value='$child_count'/></font>
                    <input type=\"hidden\" name=\"card_id\" value=\"$card_id\" />
                    <input type=\"hidden\" name=\"action\" value=\"big_pax_details\" />
                    <input type=\"hidden\" name=\"types\" value=\"1\" />
                </form>
             </font>
	 </td>
	<td align=\"center\"><font face=\"dejavusans\" size=\"$font_size\">
            <form action=\"\">
                    <input type=\"button\" onclick=\"showCustomer('pop','card_reservation_report_data','$card_num',this.form)\" value='$baby_count'/></font>
                    <input type=\"hidden\" name=\"card_id\" value=\"$card_id\" />
                    <input type=\"hidden\" name=\"action\" value=\"big_pax_details\" />
                    <input type=\"hidden\" name=\"types\" value=\"0\" />
             </font>
	 </form>
	 </td>

	<td align=\"center\">
            <font face=\"dejavusans\" size=\"$font_size\">
               <form action=\"\">
                    <input type=\"button\" onclick=\"showCustomer('pop','card_reservation_report_data','$card_id',this.form)\" value='$total'/></font>
                    <input type=\"hidden\" name=\"card_id\" value=\"$card_id\" />
                    <input type=\"hidden\" name=\"action\" value=\"big_pax_details\" />
                    <input type=\"hidden\" name=\"all_paxes\" value=\"\" />
                </form>
            </font>
	 </td>
         <td align=\"center\">
            <font face=\"dejavusans\" size=\"$font_size\">
             <form action=\"\">
                    <input type=\"button\" onclick=\"showCustomer('pop','card_reservation_report_data','$card_id',this.form)\" value='$totalfee'/></font>
                    <input type=\"hidden\" name=\"card_id\" value=\"$card_id\" />
                    <input type=\"hidden\" name=\"action\" value=\"customer_accounts\" />
             </form>
            </font></td>
        <td align=\"center\">&nbsp;";
									if ($amount_num_paid != "" && $amount_num_paid != 0) {
										$pdf.="<font face=\"dejavusans\" size=\"$font_size\"><form action=\"\">
		<input type=\"button\" onclick=\"showCustomer('pop','card_reservation_report_data','$card_num',this.form)\" value='$amount_num_paid'/></font>
		<input type=\"hidden\" name=\"card_id\" value=\"$card_num\" />
		<input type=\"hidden\" name=\"action\" value=\"customer_paid\" />
	 </font>
	 </form>";
									} else {
										$pdf.="<font face=\"dejavusans\" size=\"$font_size\">$amount_num_paid</font>";
									}

									$pdf.="&nbsp;</td>
       <td align=\"center\"><font face=\"dejavusans\" size=\"$font_size\"> " . number_format($percent_amount_paid, 2) . "</font></td>
       <td align=\"center\"><font face=\"dejavusans\" size=\"$font_size\"> $remain_fees </font></td>
       <td align=\"center\"><font face=\"dejavusans\" size=\"$font_size\" color=\"$percent_amount_remain_color\">" . number_format($percent_amount_remain, 2) . "</font></td>
       <td align=\"center\"><font face=\"dejavusans\" size=\"$font_size\"> &nbsp;$employee </font></td>
";

									$pdf.= "
	</tr>";

									$i++;
								}
								$all_total = $total_person_no + $total_person;
								$pdf.= "
       <tr>
        <td colspan=\"5\" align=\"left\"><font face=\"dejavusans\" size=\"$font_size\">$lang[all_total]</font></td>
        <td align=\"center\"><font face=\"dejavusans\" size=\"$font_size\">$total_big</font></td>
	<td align=\"center\"><font face=\"dejavusans\" size=\"$font_size\">$total_child</font></td>
	<td align=\"center\"><font face=\"dejavusans\" size=\"$font_size\">$total_baby</font></td>
        <td align=\"center\"><font face=\"dejavusans\" size=\"$font_size\">$total_person</font></td>
        <td align=\"center\"><font face=\"dejavusans\" size=\"$font_size\">$totalfee_sum</font></td>
        <td align=\"center\"><font face=\"dejavusans\" size=\"$font_size\">$amount_num_paid_sum</font></td>
        <td align=\"center\">&nbsp;</td>
        <td align=\"center\"><font face=\"dejavusans\" size=\"$font_size\">$remain_fees_sum</font></td>
        <td align=\"center\">&nbsp;</td>
        <td align=\"center\">&nbsp;</td>
";

								if ($_GET['search'] == "search") {
									echo "<tr><td>" . $pdf . "</td></tr></table>";

									echo"<div id=print style=\"visibility:hidden\">";
									echo $pdf;
									echo"</div>";
									// echo"<div align=\"center\"><a href='#' onclick=\"printdiv('print');\">Click here for print</a></div>";
									//  print_pdf2($pdf);
								}

//end show
								?>

								<?php
							}
						}
//}
					?>


