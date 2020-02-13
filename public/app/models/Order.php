<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    protected $fillable=[
        'user_id',
        'total',
        'discount_json',
    ];
    private $request;
    private $detailList;
    function __construct($request=null) {
        parent::__construct();
        $this->request=$request;
    }
    public function detail(){
        return $this->hasMany('App\models\OrderDetail');
    }
    public function withUser(){
        $user = Auth::user();
        $this->user_id=$user->id;
        return $this;
    }
    public function withDetail(){
        $this->detailList=[];
        foreach ($this->request->input() as  $value) {
              $productId= $value['id'];
              $count=$value['count'];
              $detail=(new OrderDetail())->withProductName($productId)->withProductPrice($productId)->withProductQuantity($count);
            $this->detailList[]=$detail;
         }
        return $this;
    }
    public function withTotal(){
        if(!empty($this->detailList)){
            $tmp=0;
            foreach ($this->detailList as $detail) {
                $tmp+=($detail->price * $detail->quantity);
            }
            $this->total=$tmp;
        }else{
            $this->total=0;
        }
        return $this;
    }

    public function withDiscount(){
        if($this->total>0){
                 $this->total=$this->calculateDisount($this->total);
        }
        return $this;
    }

    private function calculateDisount($total){
        //todo связать с фронтом  и вынести  в конфиги !!
        $discounts=[
               ['sum'=>1000,'percent'=>3,'text'=>'3% скидка при покупке более 1000грн.'],
               ['sum'=>2000,'percent'=>5,'text'=>'5% скидка при покупке более 2000грн.'],
               ['sum'=>3000,'percent'=>7,'text'=>'7% скидка при покупке более 3000грн.'],
        ];
        $oldTotal=$total;
        $this->discount_json='';
        foreach ($discounts as $discount) {
                if($oldTotal>=$discount['sum']){
                    $total= ($oldTotal - ($oldTotal*$discount['percent'] / 100));
                    // todo переделать
                    $this->discount_json=json_encode($discount);
                }
        }
        return $total;

    }



    public  function saveCustomRelation(){
         if(!empty($this->detailList)){
                $this->save();
             foreach ($this->detailList as $detail) {
                 $detail->order_id=$this->id;
                 $detail->save();
                }
         }
         return false;
    }
}




//$table->integer('user_id')->nullable();
//$table->decimal('total',9,2)->default(0)->comment('Всего');
//$table->text('discount_json')->comment('Скидки');
//$table->integer('status')->default(0);
