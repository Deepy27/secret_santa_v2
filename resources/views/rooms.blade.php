<?php
use App\Http\Controllers\RoomController;

$roomController = new RoomController();
$rooms = $roomController->getRooms();
?>
@include('layout.header')
<div class="form">
    <table>
        <tr>
            <th>
                Ime sobe
            </th>
            <th>
                Status sobe
            </th>
        </tr>
        <?php
        foreach ($rooms as $room) {
            echo sprintf('<tr><td><a href="/room/%s">%s</a></td><td>%s</td></tr>', $room->room_url, $room->title, $room->table_status ? 'Odprta' : 'Zaprta');
        }
        ?>
    </table>
</div>
@include('layout.footer')
