
<script>
		jQuery(document).ready(function ($) {
			$("#booking_persons_form").submit(function () {
				$("[name^='programs_extra_service_cards_persons']").each(function (index, value) {
					if ($(this).is(':checked')) {
					} else {
						$("#programs_extra_service_price_card_persons_" + index).attr("disabled", "disabled");
					}
				});
				var formdata = $("#booking_persons_form").serialize();
				$.ajax({
					type: "post",
					url: "<?php echo base_url("programs/booking_persons_form"); ?>",
					data: formdata,
					success: function (data) {
						if (data > 0) {
							alert("لقد تم حفظ الاستمارة بنجاح ورقمها : " + data);
							window.location.href = "<?php echo base_url("programs/print_reservation") ?>/" + data;

						} else {
							$("#persons_booking_form_error").html(data);
							$("[name^='programs_extra_service_cards_persons']").each(function (index, value) {
								//	$("#programs_extra_service_price_card_persons_" + index).removeAttr("disabled");
							});
						}

					}
				});
				return false;
			});


			//****************************

			$("#traveller_number").change(function () {
				AddTravellerPerson();

			});
			$("#traveller_number").blur(function () {
				AddTravellerPerson();
			});
			$("#traveller_number").keyup(function () {
				AddTravellerPerson();
			});

			$("#no_of_beds_persons").change(function () {
				CalculatePersonsReservationPrice();
			});
			$("#no_of_beds_persons").blur(function () {
				CalculatePersonsReservationPrice();
			});
			$("#no_of_beds_persons").keyup(function () {
				CalculatePersonsReservationPrice();
			});

			$("#no_of_child_persons").change(function () {
				CalculatePersonsReservationPrice();
			});
			$("#no_of_child_persons").blur(function () {
				CalculatePersonsReservationPrice();
			});
			$("#no_of_child_persons").keyup(function () {
				CalculatePersonsReservationPrice();
			});

			$("#no_of_infant_persons").change(function () {
				CalculatePersonsReservationPrice();
			});
			$("#no_of_infant_persons").blur(function () {
				CalculatePersonsReservationPrice();
			});
			$("#no_of_infant_persons").keyup(function () {
				CalculatePersonsReservationPrice();
			});
			$('[name="room_closed_number_persons[]"]').change(function () {
				CalculatePersonsReservationPrice();
			});
			$('[name="programs_extra_service_cards_persons[]"]').change(function () {
				CalculatePersonsReservationPrice();
			});
			$('[name="programs_extra_service_person_number_persons[]"]').change(function () {
				CalculatePersonsReservationPrice();
			});



		});

		function CalculatePersonsReservationPrice() {
			var TotalPrice = 0;
			var no_of_beds = parseFloat($("#no_of_beds_persons").val());
			var price_for_one_bed = parseFloat($("#price_for_one_bed_persons").val());
			TotalPrice += no_of_beds * price_for_one_bed;

			var no_of_child = parseFloat($("#no_of_child_persons").val());
			var child_price = parseFloat($("#child_price_persons").val());
			TotalPrice += no_of_child * child_price;

			var no_of_infant = parseFloat($("#no_of_infant_persons").val());
			var infant_price = parseFloat($("#infant_price_persons").val());
			TotalPrice += no_of_infant * infant_price;

			$("[name^='room_closed_number_persons']").each(function (index, value) {
				var room_closed_number = $(this).val();
				var hotel_rooms_bed = $("[name^='hotel_rooms_bed_persons']").eq(index).val();
				var hotel_rooms_price = $("[name^='hotel_rooms_price_persons']").eq(index).val();

				TotalPrice += parseFloat(room_closed_number) * parseFloat(hotel_rooms_bed) * parseFloat(hotel_rooms_price);
			});

			$("[name^='programs_extra_service_person_number_persons']").each(function (index, value) {
				var programs_extra_service_person_number = $(this).val();
				var programs_extra_service_person_number_price = $("[name^='programs_extra_service_price_person_persons']").eq(index).val();

				TotalPrice += parseFloat(programs_extra_service_person_number) * parseFloat(programs_extra_service_person_number_price);
			});

			$("[name^='programs_extra_service_cards_persons']").each(function (index, value) {
				if ($(this).is(':checked')) {
					var programs_extra_service_price_card = $("[name^='programs_extra_service_price_card_persons']").eq(index).val();
					TotalPrice += parseFloat(programs_extra_service_price_card);
				}
			});



			$("#final_price_persons_card").html(TotalPrice);


		}
		function AddTravellerPerson() {
			var traveller_number = $("#traveller_number").val();
			$("#traveller_information").html("");
			for (var index = 1; index <= traveller_number; index++) {
				var data = $("#ttraveller_one_person").html();
				$("#traveller_information").append(data)
			}

		}
</script>

<script>
		jQuery(document).ready(function ($) {
			$("#booking_groups_form").submit(function () {
				$("[name^='programs_extra_service_cards']").each(function (index, value) {
					//var programs_extra_service_price_card = $("[name^='programs_extra_service_price_card']").eq(index).val();
					if ($(this).is(':checked')) {
					} else {
						$("#programs_extra_service_cards_" + index).attr("disabled", "disabled");
					}
				});

				var formdata = $("#booking_groups_form").serialize();
				$.ajax({
					type: "post",
					url: "<?php echo base_url("programs/booking_groups_form"); ?>",
					data: formdata,
					success: function (data) {
						if (data > 0) {
							alert("لقد تم حفظ الاستمارة بنجاح ورقمها : " + data);
							window.location.href = "<?php echo base_url("programs/print_reservation") ?>/" + data;

						} else {
							$("#closed_booking_form_error").html(data);
							$("[name^='programs_extra_service_cards']").each(function (index, value) {
								$("#programs_extra_service_cards_" + index).removeAttr("disabled");
							});
						}

					}
				});
				return false;
			});
			$("#no_of_beds").change(function () {
				CalculateClosedReservationPrice();
			});
			$("#no_of_beds").blur(function () {
				CalculateClosedReservationPrice();
			});
			$("#no_of_beds").keyup(function () {
				CalculateClosedReservationPrice();
			});

			$("#no_of_child").change(function () {
				CalculateClosedReservationPrice();
			});
			$("#no_of_child").blur(function () {
				CalculateClosedReservationPrice();
			});
			$("#no_of_child").keyup(function () {
				CalculateClosedReservationPrice();
			});

			$("#no_of_infant").change(function () {
				CalculateClosedReservationPrice();
			});
			$("#no_of_infant").blur(function () {
				CalculateClosedReservationPrice();
			});
			$("#no_of_infant").keyup(function () {
				CalculateClosedReservationPrice();
			});
			$('[name="room_closed_number[]"]').change(function () {
				CalculateClosedReservationPrice();
			});
			$('[name="programs_extra_service_cards[]"]').change(function () {
				CalculateClosedReservationPrice();
			});
			$('[name="programs_extra_service_person_number[]"]').change(function () {
				CalculateClosedReservationPrice();
			});



		});

		function CalculateClosedReservationPrice() {
			var TotalPrice = 0;
			var no_of_beds = parseFloat($("#no_of_beds").val());
			var price_for_one_bed = parseFloat($("#price_for_one_bed").val());
			TotalPrice += no_of_beds * price_for_one_bed;

			var no_of_child = parseFloat($("#no_of_child").val());
			var child_price = parseFloat($("#child_price").val());
			TotalPrice += no_of_child * child_price;

			var no_of_infant = parseFloat($("#no_of_infant").val());
			var infant_price = parseFloat($("#infant_price").val());
			TotalPrice += no_of_infant * infant_price;

			$("[name^='room_closed_number']").each(function (index, value) {
				var room_closed_number = $(this).val();
				var hotel_rooms_bed = $("[name^='hotel_rooms_bed']").eq(index).val();
				var hotel_rooms_price = $("[name^='hotel_rooms_price']").eq(index).val();

				TotalPrice += parseFloat(room_closed_number) * parseFloat(hotel_rooms_bed) * parseFloat(hotel_rooms_price);
			});

			$("[name^='programs_extra_service_person_number']").each(function (index, value) {
				var programs_extra_service_person_number = $(this).val();
				var programs_extra_service_person_number_price = $("[name^='programs_extra_service_price_person']").eq(index).val();

				TotalPrice += parseFloat(programs_extra_service_person_number) * parseFloat(programs_extra_service_person_number_price);
			});

			$("[name^='programs_extra_service_cards']").each(function (index, value) {
				//var programs_extra_service_price_card = $("[name^='programs_extra_service_price_card']").eq(index).val();
				if ($(this).is(':checked')) {
					var programs_extra_service_price_card = $("#programs_extra_service_cards_" + index).val();
					if (programs_extra_service_price_card > 0) {
						TotalPrice += parseFloat(programs_extra_service_price_card);
					}
				}
			});



			$("#final_price_close_card").html(TotalPrice);


		}

</script>


</body>
</html>
<div class="row" id="ttraveller_one_person" style="display: none">

    <div class="row">
        <div class="col-lg-4">
            <label>  الاسم :</label>
            <input type="text" name="traveller_name[]"  required="required"/>
        </div>
        <div class="col-lg-4">
            <label class="col-lg-12">  النوع :</label>
            <select class="col-lg-12 form-control" name="traveller_gender[]"  required="required">
                <option value="0">ذكر </option>
                <option value="1"> انثى </option>
            </select>
        </div>
        <div class="col-lg-4">
            <label>  تاريخ الميلاد :</label>
            <input type='date' required="required" name="traveller_birthdate[]" max="<?= date("Y-m-d"); ?>" class="form-control" />

        </div>
    </div>

    <hr/>
</div>
