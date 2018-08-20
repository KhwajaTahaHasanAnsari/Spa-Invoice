<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Helper\HasManyRelation;

class Invoice extends Model
{
   use HasManyRelation;
    protected $fillable = [

        'customer_id', 'date','due_date','discount',
        'terms_and_conditions'

    ];

    protected $guarded = [

        'number', 'sub_total', 'total'
    ];

    public function customer()
    {

        return $this->belongsto(Customer::class);

    }

    public function item(){

        return  $this->belongsToMany(InvoiceItem::class);

    }
    public function setSubTotalAttribute($value)
    {

        $this->attributes['sub_total'] = $value;
        $discount = $this->attributes['discount'];
        $this->attributes['total'] = $value - $discount;
    }
}
