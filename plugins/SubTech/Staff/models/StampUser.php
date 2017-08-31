<?php

namespace Plugins\SubTech\Staff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Plugins\SubTech\Stamp\StampUser
 *
 * @property string $user
 * @property int $userid
 * @property string $category
 * @property string $email
 * @property string $image
 * @property string $title
 * @property string $phone_work
 * @property string $description
 * @property string $skype
 * @property string $linkedin
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Block[] $blocks
 * @method static \Illuminate\Database\Eloquent\Builder|\Plugins\SubTech\Staff\StampUser whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Plugins\SubTech\Staff\StampUser whereUserid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Plugins\SubTech\Staff\StampUser whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Plugins\SubTech\Staff\StampUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Plugins\SubTech\Staff\StampUser whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Plugins\SubTech\Staff\StampUser whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Plugins\SubTech\Staff\StampUser wherePhoneWork($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Plugins\SubTech\Staff\StampUser whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Plugins\SubTech\Staff\StampUser whereSkype($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Plugins\SubTech\Staff\StampUser whereLinkedin($value)
 * @mixin \Eloquent
 */
class StampUser extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'userid';

    protected $table = 'subtech_staff_users';

    protected $fillable = [
        'user',
        'userid',
        'category',
        'email',
        'image',
        'title',
        'phone_work',
        'description',
        'skype',
        'linkedin',
    ];

}