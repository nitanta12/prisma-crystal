<?php

namespace App\Repositories;

use App\Models\CreativeBrief;
use App\Repositories\BaseRepository;

/**
 * Class CreativeBriefRepository
 * @package App\Repositories
 * @version November 27, 2019, 11:59 am +0545
*/

class CreativeBriefRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'campaign_id',
        'creative_brief_name',
        'creative_brief_file'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CreativeBrief::class;
    }
}
