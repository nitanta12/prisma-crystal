<?php

namespace App\Repositories;

use App\Models\Campaign;
use App\Repositories\BaseRepository;

/**
 * Class CampaignRepository
 * @package App\Repositories
 * @version October 22, 2019, 10:29 am UTC
*/

class CampaignRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'campaign_name',
        'campaign_description'
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
        return Campaign::class;
    }
}
