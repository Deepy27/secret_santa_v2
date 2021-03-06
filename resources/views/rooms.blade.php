<?php
use App\Http\Controllers\RoomController;

$roomController = new RoomController();
$rooms = $roomController->getRooms();
?>
@include('layout.header')
<div class="room-view">
    <table class="room-view-table">
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
            echo sprintf('<tr><td><a href="/room/%s">%s</a></td><td>%s</td></tr>', $room->room_url, $room->title, $room->table_status ? 'Odprta <i class="fas fa-unlock rooms"></i>' : 'Zaprta <i class="fas fa-lock rooms"></i>');
        }
        ?>
    </table>
</div>
@include('layout.footer')
