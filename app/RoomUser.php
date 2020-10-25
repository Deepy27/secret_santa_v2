<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Integer;
use phpDocumentor\Reflection\Types\String_;

/**
 * Class RoomUser
 * @package App
 * @property int room_id
 * @property int user_id
 */

class RoomUser extends Model
{
    //
    /**
     * @param int $roomId
     */
    public function joinRoom (int $roomId) {
        $this->room_id = $roomId;
        $this->user_id = Auth::id();
        $this->save();
    }
}
