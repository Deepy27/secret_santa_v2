<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Boolean;
use phpDocumentor\Reflection\Types\Integer;

/**
 * Class Room
 * @package App
 * @property string title
 * @property string room_url
 * @property string room_password
 * @property string admin_user_id
 * @property string table_status
 */
class Room extends Model
{
    protected $primaryKey = 'room_id';
    /**
     * @var int
     */
    private $room_id;

    /**
     * @param string $title
     * @param int $roomUrl
     * @param string $password
     * @param int $adminUserId
     * @param bool $status
     */
    public function createRoom(string $title, int $roomUrl, string $password, int $adminUserId, bool $status)
    {
        $this->title = $title;
        $this->room_url = $roomUrl;
        $this->room_password = $password;
        $this->admin_user_id = $adminUserId;
        $this->table_status = $status;
        $this->save();
    }

    /**
     * @param int $roomUrl
     * @return Model|Builder|object|null
     */
    public function getRoom(int $roomUrl)
    {
        return DB::table('rooms')->where('room_url', '=', $roomUrl)->first();
    }

    /**
     * @param int $roomUrl
     * @return bool
     */
    public function isAdmin(int $roomUrl): bool
    {
        return !!DB::table('rooms')->where('admin_user_id', '=', Auth::id())->where('room_url', '=', $roomUrl)->first();
    }

    /**
     * @param int $title
     * @return Model|Builder|object|null
     */
    public function getRoomName(int $title)
    {
        return DB::table('rooms')->where('title', '=', $title)->first();
    }
}
