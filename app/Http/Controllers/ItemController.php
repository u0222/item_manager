<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
// use App\Http\Controllers\Auth;
use App\Http\Requests\CreateItemRequest;
use App\Http\Requests\EditStockRequest;
use App\Http\Requests\EditItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ItemController extends Controller
{
    // 商品一覧ページの表示
    public function index(Request $request)
    {
        $sql = Item::query()->whereNull("deleted_at");

        $re = $request->all();

        if(!empty($re['name'])){
            $sql->where('name',$re['name']);
        }
        if(!empty($re['price'])){
            $sql->where('price','=',$re['price']);
        }
        // データを取得
        $items = $sql->get();
        // 画面で利用する変数として$itemsを連想配列で渡す
        return view("item.index", ['items' => $items]);
    }

    // 商品登録ページ表示用
    public function showAdd()
    {
        $categories = Category::all();

        return view('item.add', ['categories' => $categories]);
    }

    // 商品登録の実行
    public function add(CreateItemRequest $request)
    {
        $item = new Item;

        if($item->fill($request->all())->save()) {
            Log::info('商品の登録が正常に行われました',['item_id' => $item->id]);
            return redirect('/item');
        }
        Log::error('商品の登録ができませんでした', ['data' => $request->all()]);
        return redirect('/item');
    }    

    // 商品編集ページ
    public function showEdit($id)
    {
        $item = Item::find($id);

        $categories = Category::all();

        return view("item.edit", [
            "item" => $item,
            "categories" => $categories
        ]);
    }

    // 商品編集の実行
    public function edit($id, EditItemRequest $request)
    {
        $item = Item::find($id);

        $item->fill($request->all())->save();

        return redirect('/item');
    }

    // 商品削除の実行
    public function delete($id)
    {
        $item = Item::find($id);

        $date = date("Y-m-d H:i:s");

        $item->deleted_at = $date;
        $item->save();

        return redirect('/item');
    }

    public function editStock(EditStockRequest $request, $id)
    {
        $item = Item::find($id);

        $stock = collect($request->input('stock'))->values()->first();

        $key = collect($request->input('stock'))->keys()->first();

        if($request->has('in')){
            $item->stock += $stock;
        } else if($request->has('out')) {
            if ($item->stock == 0){
                throw ValidationException::withMessages([
                    'stock.' . $key =>'在庫がありません'
                ]);
            } else if($item->stock < $stock) {
                throw ValidationException::withMessages([
                    'stock.' . $key =>'出荷数は在庫数以下の数字を入力してください'
                ]);
            } else {
                $item->stock -= $stock;
            }
        }

        $item->save();

        return redirect('/item');
    }

    public function detail()
    {
        // $id = Auth::user()->id;

        // return view('item.detail', ['id' => $id]);
        return view('item.detail');
    }    
}
