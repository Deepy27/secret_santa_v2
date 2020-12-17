@include('layout.header');
<?php
use App\Http\Controllers\RoomController;

$userList = (new RoomController())->getUserList($roomUrl);
?>
<div class="fullScreenLayout">
    <table class="room-view-table">
        <tr>
            <th>
                Uporabnik
            </th>
            <th>
                Obdarovanec
            </th>
        </tr>
        <?php
        foreach ($userList as $item) {
            echo sprintf('
              <tr>
                <td class="text-center">%s</td>
                <td>%s</td>
              </tr>
            ', $item->user, $item->pickedUser);
            echo '<tr>';
            echo '</tr>';
        }
        ?>
    </table>
</div>
@include('layout.footer');
