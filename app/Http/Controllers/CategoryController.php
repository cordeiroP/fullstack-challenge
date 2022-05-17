<?php

namespace App\Http\Controllers;

//use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\QueryException;
use App\Models\Category;


class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth:api');
        //
    }

    public function category(Request $request)
    {
        $validator = Validator::make(

            $request->all(),
            [
                'name'=>'required|string|min:5'
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            try {
                //register Category
                $this->createCategory($request);
                return response()->json(['Category create sucess '], Response::HTTP_CREATED);
            } catch (QueryException $exception) {
                return response()->json(['error' => 'erro de conexão com a base de dados ' . $exception], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function destroyCategory($id)
    {
        try {
            $category = Category::find($id)->delete();
            return response()->json(null, Response::HTTP_OK);
        } catch (QueryException $exception) {
            return response()->json(['error' => 'erro de conexão com a base de dados ' . $exception], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function createCategory(Request $request)
    {

        try {

            $category = new Category();
            $category->name=$request["name"];
            $category->save();

            return response()->json(null, Response::HTTP_OK);
        } catch (QueryException $exception) {
            return response()->json(['error' => 'erro de conexão com a base de dados ' . $exception], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function listCategory()
    {
        try {

            $category = Category::all();
            /*Publicacao::join('user_interno','user_interno.user_id',"=",'user.id')
            ->get(['user.nome', 'user.email','user_interno.telefone','user_interno.bi','user_interno.data_nascimento','user_interno.id']);
         */
            if (count($category) > 0)
                return response()->json($category, Response::HTTP_OK);
            else
                return response()->json([], Response::HTTP_OK);
        } catch (QueryException $exception) {
            return response()->json(['error' => 'erro de conexão com a base de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateCategory($id, Request $request)
    {
        try {
            $category = Category::find($id)->update($request->all());

            return response()->json([$request->all(),$id], Response::HTTP_OK);
        } catch (QueryException $exception) {
            return response()->json(['error' => 'erro de conexão com a base de dados ' . $exception], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    //
}
