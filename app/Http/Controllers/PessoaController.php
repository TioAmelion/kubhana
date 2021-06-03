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
                        <div class="search" id="search">
                            <div class="post-bar-search">
                                <div class="post_topbar-search">
                                    <div class="usy-dt-search">
                                        <img src="assets/images/resources/us-pic.png" alt="">
                                        <div class="usy-name-search">
                                            <h3>'. $row->name .'</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
                
            } else {
                $output .= '<span>Nao existe</span>';
            }
            return response()->json($output);
        }
    }
}
