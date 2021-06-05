<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\instituicao;
use App\Models\User;
use DB;

class PessoaController extends Controller
{
    public function index(){
        return view('search');
    }

    public function autocomplete(Request $request)
    {
        $output = '';

        if($request->ajax()) {

            $fetch = $request->get('query');

            if($fetch != '') {
                $data = User::where('name', 'like', '%'.$fetch.'%')->get();
            } else {
                return response()->json(['data' => $data = "Digite alguma coisa"]);
            }

            $total_row = $data->count();

            if ($total_row > 0) {
                foreach ($data as $row) {
                    $output .=  '
                    <div id="teste" style="position: absolute;width: 306px;height: 59px;background: #fdfdfd;top: 54px;">
                        <div class="res">
                            <img src="assets/images/resources/us-pic.png" alt="" style="position: relative;top: 5px;left: 8px;">
                            <span style="margin-left: 19px;float: left;position: relative;top: 20px;">'.$row->name.'</span>
                        </div>
                    </div>
                    ';
                }
                
            } else {
                $output .= '<span>Nao existe</span>';
            }
            return response()->json($output);
        }
    }
}
