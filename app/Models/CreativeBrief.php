<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CreativeBrief
 * @package App\Models
 * @version November 27, 2019, 11:59 am +0545
 *
 * @property integer campaign_id
 * @property string creative_brief_name
 * @property string creative_brief_file
 */
class CreativeBrief extends Model
{
    use SoftDeletes;

    public $table = 'creative_briefs';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'campaign_id',
        'creative_brief_name',
        'creative_brief_file'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'campaign_id' => 'integer',
        'creative_brief_name' => 'string',
        'creative_brief_file' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'creative_brief_name' => 'required'
    ];

    public function users(){
        return $this->belongsTo('App\User','creative_user_id');
    }
    
}
