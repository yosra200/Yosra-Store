<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class category extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'name', 'parent_id ','descriptioons','image','slug','status'
     ];
     
    public function products(){

     return $this->hasMany(product::class,'category_id','id');
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id')
            ->withDefault([
                'name' => '-_-'
            ]);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

     public function scopeActive(Builder $builder)
     {
         $builder->where('status', '=', 'active');
     }
   
     public function scopeFilter(Builder $builder, $filters)
     {
 
         $builder->when($filters['name'] ?? false, function($builder, $value) {
             $builder->where('categories.name', 'LIKE', "%{$value}%");
         });
 
         $builder->when($filters['status'] ?? false, function($builder, $value) {
             $builder->where('categories.status', '=', $value);
         });
 
     }



    public static function rules($id=0)
     {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'unique:categories,name',
                 'filter:php,laravel,html',
                //new Filter(['php', 'laravel', 'html']),
            ],
            'parent_id' => [
                'nullable', 'int', 'exists:categories,id'
            ],
            'image' => [
                'image', 'max:1048576', 'dimensions:min_width=100,min_height=100',
            ],
            'status' => 'required|in:Active,Archived',
        ];

     }
}
