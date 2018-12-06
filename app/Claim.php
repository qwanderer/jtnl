<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Claim extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function scopeFilter($builder, $filters)
    {
        return $filters->apply($builder);
    }








    public function getImgsAttribute($value)
    {
        return json_decode($value,1);
    }

    public function setImgsAttribute($value)
    {
        if(!is_array($value)){
            $value = [];
        }
        $this->attributes['imgs'] = json_encode($value);
    }



    public static function getValidationRules()
    {
        return [
            'title'=>"required|min:5|max:255",
            'descr'=>"required|min:5|max:255",
            'rail_id'=>'exists:rails,id',
            'category_id'=>'exists:categories,id',
            'imgs.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

    public function storageDir()
    {
        return floor($this->id / 100).'/'.$this->id.'/';
    }

    public function saveImages($images=[])
    {
        if($images and is_array($images) and count($images)>0)
        {
            if (!Storage::disk('claims')->exists($this->storageDir())) {
                Storage::disk('claims')->makeDirectory($this->storageDir());
            }
            $all_images = $this->imgs ? $this->imgs : [];
            foreach($images as $image)
            {
                $name = time().rand(1000,9999).'.'.$image->getClientOriginalExtension();
                $image->storeAs($this->storageDir(), $name  ,'claims');
                $all_images[] = $name;
            } // foreach
            $this->save();
        } // if

    } // func

} // class
