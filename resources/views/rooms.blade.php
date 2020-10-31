<?php
use App\Http\Controllers\RoomController;

$roomController = new RoomController();
$rooms = $roomController->getRooms();
?>
@include('layout.header')
<div class="col-md-4 col-lg-4">
    <div class="form">
        <table>
            <tr>
                <th class="small">
                    Ime sobe
                </th>
                <th class="small">
                    Status sobe
                </th>
            </tr>
            <?php
            foreach ($rooms as $room) {
                echo
                sprintf('<tr>
                    <td class="small">
                        <a href="/room/%s">
                            %s
                        </a>
                    </td>
                    <td class="small">
                        %s
                    </td>
                </tr>',
                    $room->room_url,
                    $room->title,
                    $room->table_status ? 'Odprta <i class="fas fa-unlock rooms"></i>' : 'Zaprta <i class="fas fa-lock rooms"></i>'
                );
            }
            ?>
        </table>
    </div>
</div>
@include('layout.footer')
