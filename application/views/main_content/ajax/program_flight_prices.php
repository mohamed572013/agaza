<table class="table table-bordered table-hover">
    <thead class="alert-success">
        <tr>
                <!--<th>تاريخ الرحلة</th>-->
            <th>  نوع الغرفة</th>
            <th>  السعر    </th>
            <th>   المتاح</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($program_flight_info_prices->room_prices as $room) { ?>
                <tr>
                    <td><?= $room->title_ar ?></td>
                    <td><?= $room->price ?></td>
                    <td><?= $room->number_of_rooms ?></td>
                </tr>
            <?php } ?>
    </tbody>
    <thead class="alert-success">
        <tr>
                <!--<th>تاريخ الرحلة</th>-->
            <th></th>
            <th>  سعر الطفل  </th>
            <th> سعر الرضيع</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> </td>
            <td><?= $program_flight_info_prices->child_price ?></td>
            <td><?= $program_flight_info_prices->infant_price ?></td>

        </tr>
    </tbody>
</table>