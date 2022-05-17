<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination;
use App\Models\Category;


class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function order(Request $request)
    {
        $validator = Validator::make(

            $request->all(),
            [
                'contactName'=>'required|string|min:10',
                'contactPhone'=>'required|integer',
                'realState'=>'required|string|min:5|max:100',
                'description'=>'required|string|min:10',
                'company'=>'required|string|min:5||max:100'
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            try {
                //register order
                $this->createOrder($request);
                return $this->home();
                //return response()->json(['order create sucess '], Response::HTTP_CREATED);
            } catch (QueryException $exception) {
                return response()->json(['error' => 'erro de conexão com a base de dados ' . $exception], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function destroyOrder($id)
    {
        try {
            $user = Order::find($id)->delete();
            return response()->json(null, Response::HTTP_OK);
        } catch (QueryException $exception) {
            return response()->json(['error' => 'erro de conexão com a base de dados ' . $exception], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function createOrder(Request $request)
    {

        try {

            $order = new Order();
            $order->contactName = $request["contactName"];
            $order->contactPhone = $request["contactPhone"];
            $order->realState = $request["realState"];
            $order->description = $request["description"];
            $order->company=$request["company"];
            $order->category_id=$request["category"];

            $order->save();

            return response()->json($order->id, Response::HTTP_OK);
        } catch (QueryException $exception) {
            return response()->json(['error' => 'erro de conexão com a base de dados ' . $exception], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function listOrder()
    {
        try {

            $order = Order::all();
            /*Publicacao::join('user_interno','user_interno.user_id',"=",'user.id')
            ->get(['user.nome', 'user.email','user_interno.telefone','user_interno.bi','user_interno.data_nascimento','user_interno.id']);
         */
            if (count($order) > 0)
                return response()->json($order, Response::HTTP_OK);
            else
                return response()->json([], Response::HTTP_OK);
        } catch (QueryException $exception) {
            return response()->json(['error' => 'erro de conexão com a base de dados list order'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateOrder($id, Request $request)
    {
        try {
            $order = Order::find($id)->update($request->all());
            return response()->json($order, Response::HTTP_OK);
        } catch (QueryException $exception) {
            return response()->json(['error' => 'erro de conexão com a base de dados ' . $exception], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function home(){
        $query['orders'] = DB::table('order')
             ->join('category', 'category.id', '=', 'order.category_id')
             ->get(['order.id as id','order.contactName','order.description', 'order.contactPhone','order.contactPhone','order.realState','order.company','order.created_at as deadline','category.name as category']);
            // ->get();
            $category['category'] = Category::all();
             //dd($query['orders']);
        return view('home',$query,$category);
    }


    //
}
