<?php

namespace App\Repositories;

use App\Models\vendors;
use App\Repositories\BaseRepository;

/**
 * Class vendorsRepository
 * @package App\Repositories
 * @version November 4, 2019, 8:54 am UTC
*/

class vendorsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'vendor_name',
        'vendor_type',
        'vendor_phone',
        'vendor_address',
        'vendor_description'
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
        return vendors::class;
    }
}
