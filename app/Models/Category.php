<?php

namespace App\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Category.
 *
 * @package namespace App\Models;
 */
class Category extends Model implements Transformable, TableInterface
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'stream',
        'card_active',
        'card_inactive',
        'status',
        'page',
        'frequency',
        'icon'
    ];

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#', 'Nome', 'Frequência', 'Stream', 'Status', 'Ionic Page'];
    }

    /**
     *  'Card Active', 'Card Inactive',
     *   case 'Card Active':
     *   return $this->card_active;
     *   case 'Card Inactive':
     *   return $this->card_inactive;
     * */

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header){
            case '#':
                return $this->id;
            case 'Nome':
                return $this->name;
            case 'Frequência':
                return $this->frequency;
            case 'Stream':
                return $this->stream;
            case 'Status':
                return $this->status;
            case 'Ionic Page':
                return $this->page;
        }
    }

}
