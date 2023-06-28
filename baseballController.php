<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PitchingStats;

class baseballController extends Controller
{
    // public function index(){
    //     $items = DB::select('select * from pitcher_stats');
    //     return view('baseball',['items' => $items]);
    // }

    //Using query builder
    public function index(Request $request){
      $pitching_stats=new PitchingStats;  
      // $items=$pitching_stats->get();
      // top 10 player
      $items=$pitching_stats->orderby('fip')->take(10)->get();
      return view('baseball',['items'=>$items]);
    }

    public function add(Request $request){
        return view('pitching_add');
    }

    // Without using model
    // public function create(Request $request)
    // {
    //   $team=$request->team;
    //   $name=$request->name;
    //   $game=$request->game;
    //   $batter=$request->batter;
    //   $ip=$request->ip;
    //   $hit=$request->hit;
    //   $hr=$request->hr;
    //   $bb=$request->bb;
    //   $ib=$request->ib;
    //   $db=$request->db;
    //   $so=$request->so;
    //   $wild=$request->wild;
    //   //Calicurating FIP
    //   $fip=((($bb*3+$hr*13)-($so*2))/$ip)+3.12;
    //   $hr9=($hr/$ip)*9;
    //   $bb9=($bb/$ip)*9;
    //   $k9=($so/$ip)*9;
    //   // babip(without considering sacrifice.)
    //   $babip=($hit-$hr)/(($batter-$bb-$ib-$db)-$so-$hr);

    //   //Autoincriment
    //   $playerID=null;
    //   //Designating parameters
    //   $param=[
    //     'id'=>$playerID,
    //     'team'=>$team,
    //     'name'=>$name,
    //     'ip'=>$ip,
    //     'game'=>$game,
    //     'batter'=>$batter,
    //     'ip'=>$ip,
    //     'hit'=>$hit,
    //     'hr'=>$hr,
    //     'bb'=>$bb,
    //     'ib'=>$ib,
    //     'db'=>$db,
    //     'so'=>$so,
    //     'fip'=>$fip,
    //     'hr9'=>$hr9,
    //     'bb9'=>$bb9,
    //     'k9'=>$k9,
    //     'wild'=>$wild,
    //     'babip'=>$babip,
    //   ];
    //   //Inserting new record.
    //   DB::table('pitching_stats')->insert($param);
    //   return redirect('baseball');
    // }

      public function create(Request $request){
        $this->validate($request,PitchingStats::$rules);
        $PitchingStats=new PitchingStats;
        // $form=$request->all();
        // unset($form['_token']);
        
        // define varriants to compute
        $batter=$request->batter;
        $ip=$request->ip;
        $hit=$request->hit;
        $hr=$request->hr;
        $bb=$request->bb;
        $ib=$request->ib;
        $db=$request->db;
        $so=$request->so;
        
        // set values to instance
        $PitchingStats->team=$request->team;
        $PitchingStats->name=$request->name;
        $PitchingStats->game=$request->game;
        $PitchingStats->batter=$request->batter;
        $PitchingStats->ip=$request->ip;
        $PitchingStats->hit=$request->hit;
        $PitchingStats->hr=$request->hr;
        $PitchingStats->bb=$request->bb;
        $PitchingStats->ib=$request->ib;
        $PitchingStats->db=$request->db;
        $PitchingStats->so=$request->so;
        $PitchingStats->wild=$request->wild;
        $PitchingStats->fip=((($bb*3+$hr*13)-($so*2))/$ip)+3.12;
        $PitchingStats->hr9=($hr/$ip)*9;
        $PitchingStats->bb9=($bb/$ip)*9;
        $PitchingStats->k9=($so/$ip)*9;
        
        // babip(without considering sacrifice(cuz there is no data of sacrifice).)
        $PitchingStats->babip=($hit-$hr)/(($batter-$bb-$ib-$db)-$so-$hr);
        // $PitchingStats->fill($form)->save();
        $PitchingStats->save();
        return redirect('baseball');
      }

    public function edit(Request $request){
      if($request->playerID!==null){
        $item=DB::table('pitcher_stats')
        ->where('playerID',$request->playerID)->first();
        return view("baseball_edit",['form'=>$item]);
      }else{
        $item=DB::table('pitcher_stats')->first();
        // return view("baseball",['items'=>$items]);
        return view("baseball_edit",['form'=>$item]);
      }
    }

    public function update(Request $request){
      //Calicurating FIP
      $ip=$request->IP;
      $so=$request->SO;
      $bb=$request->BB;
      $db=$request->DB;
      $hr=$request->HR;
      $fip=((($bb*3+$hr*13)-($so*2))/$ip)+3.12;
      //Autoincriment
      //$playerID=null;
      //Designating parameters
      $param=[
        'playerID'=>$request->playerID,
        'lastname'=>$request->lastname,
        'firstname'=>$request->firstname,
        'ip'=>$ip,
        'so'=>$so,
        'bb'=>$bb,
        'db'=>$db,
        'hr'=>$hr,
        'fip'=>$fip
      ];
      //Updating existing record.
      DB::update('update pitcher_stats set lastname=:lastname, firstname=:firstname, ip=:ip, so=:so, bb=:bb, db=:db, hr=:hr, fip=:fip
      where playerID=:playerID',$param);
      return redirect('baseball');
    }

    // public function del(Request $request){
    //   $param=['playerID'=>$request->playerID];
    //   $item=DB::select('select * from pitcher_stats where playerID = :playerID',$param);
    //   return view('baseball_del',['form'=>$item[0]]);
    // }
    // public function remove(Request $request){
    //   $param=['playerID'=>$request->playerID];
    //   DB::delete('delete from pitcher_stats where playerID = :playerID',$param);
    //   return redirect('baseball');
    // }
    public function del(Request $request){
      $item=DB::table('pitcher_stats')
      ->where('playerID',$request->playerID)->first();
      return view('baseball_del',['form'=>$item]);
    }
    
    public function remove(Request $request){
      DB::table('pitcher_stats')
      ->where('playerID',$request->playerID)->delete();
      return redirect('baseball');
    }

    public function show(Request $request){
      $playerID=$request->playerID;
      $item=DB::table('pitcher_stats')->where('playerID',$playerID)->first();
      return view('baseball_show',['item'=>$item]);
    }
    public function showSearch(Request $request){
      $condition=$request->condition;
      $items=DB::table('pitcher_stats')
      ->where('lastname','like','%' .$condition .'%')
      ->orwhere('firstname','like','%' .$condition .'%')
      ->get();
      return view('baseball_multishow',['items'=>$items]);
    }
    public function showBetween(Request $request){
      $min=$request->min;
      $max=$request->max;
      $items=DB::table('pitcher_stats')
      ->whereRaw('playerID >= ? and playerID <=?',
      [$min,$max])->get();
      return view('baseball_multishow',['items'=>$items]);
    }
    public function indexOrder(Request $request){
      $items=DB::table('pitcher_stats')->orderBy('playerID','desc')->get();
      return view('baseball',['items'=>$items]);
    }
    public function showOffLim(Request $request){
      $page=$request->page;
      $items=DB::table('pitcher_stats')
      ->offset($page * 3)
      ->limit(3)
      ->get();
      return view('baseball_multishow',['items'=>$items]);
    }

    public function readCsv()
    {
      // CSVファイルを取得する
      // $tmp = mt_rand() . "." . '/resources/tmp/test.csv'
      $temp='test.csv'; 
      // $request->file('csv')->move(public_path() . "/tmp", $tmp);
      $filepath = "app\\" . $temp;
      $items=['items'=>$filepath];
      // // CSV取得
      $file = new \SplFileObject(storage_path($filepath));
      $file->setFlags(
        \SplFileObject::READ_CSV | 
        \SplFileObject::READ_AHEAD |
        \SplFileObject::SKIP_EMPTY |
        \SplFileObject::DROP_NEW_LINE 
      );
      //各行を処理する
      foreach ($file as $line) {
      //   //team	name	games	batter	IP	hit	hr	bb	ib	db	so	wild
      //   $team=$line[0];
      //   $name=$line[1];
      //   $game=$line[2];
      //   $batter=$line[3];
      //   $ip=$line[4];
      //   $hit=$line[5];
      //   $hr=$line[6];
      //   $bb=$line[7];
      //   $ib=$line[8];
      //   $db=$line[9];
      //   $so=$line[10];
      //   $wild=$line[11];
      //   //Calicurating FIP
      //   $fip=round(((($bb*3+$hr*13)-($so*2))/$ip)+3.12,2);
      //   $hr9=round(($hr/$ip)*9,2);
      //   $bb9=round(($bb/$ip)*9,2);
      //   $k9=round(($so/$ip)*9,2);
      //   // babip(without considering sacrifice.)
      //   $babip=round(($hit-$hr)/(($batter-$bb-$ib-$db)-$so-$hr),3);
        //Autoincriment
        // $playerID=null;
        //Designating parameters
        // $param=[
        //   'id'=>$playerID,
        //   'team'=>$team,
        //   'name'=>$name,
        //   'ip'=>$ip,
        //   'game'=>$game,
        //   'batter'=>$batter,
        //   'ip'=>$ip,
        //   'hit'=>$hit,
        //   'hr'=>$hr,
        //   'bb'=>$bb,
        //   'ib'=>$ib,
        //   'db'=>$db,
        //   'so'=>$so,
        //   'fip'=>$fip,
        //   'hr9'=>$hr9,
        //   'bb9'=>$bb9,
        //   'k9'=>$k9,
        //   'wild'=>$wild,
        //   'babip'=>$babip,
        // ];
        $param=[
          'name'=>$line[0],
          'birth_date'=>$line[1],
          'birth_place'=>$line[2],
          'height'=>$line[3],
          'weight'=>$line[4],
          'blood_type'=>$line[5],
          'pithc_rl'=>$line[6],
          'bat_rl'=>$line[7],
          'draft_year'=>$line[8],
          'draft_rank'=>$line[9],
          'career'=>$line[10],
        ];
        //Inserting new record.
        DB::table('pitcher_profile')->insert($param);
        // // 一時ファイルを削除する
        // unlink($filepath);
      }
      return redirect('baseball');
    }

    public function sort(Request $request){
      $items=DB::table('pitching_stats')->orderby($request->sort)->get();
      return view('baseball',['items'=>$items]);
  }

  public function csvUploadDisp(){
    return view('baseball_csvupload');
  }
  public function csvUploadProcess(Request $request){
    // CSVファイルを取得する
    $tmp = mt_rand() . "." . $request->file('csvFile')->guessExtension();  //mt_rand() random number generator //guessExtension() check extension
    // move uploaded file into public folder's belongings.
    $request->file('csvFile')->move(public_path() . "/tmp", $tmp);
    // public_path() publicの場所を表示
    $filepath = public_path() . "/tmp/" . $tmp;

    // Declaring file object
    $file = new \SplFileObject($filepath);
    $file->setFlags(
        // read rows as csv column
        \SplFileObject::READ_CSV |
        // 先読み/巻き戻しで読み出し 
        \SplFileObject::READ_AHEAD |
        // skipping empty rows
        \SplFileObject::SKIP_EMPTY |
        // skip like \r\n symbol at the end of row
        \SplFileObject::DROP_NEW_LINE 
    );
    //processing read csv datas
    foreach($file as $line){
      // //team	name	games	batter	IP	hit	hr	bb	ib	db	so	wild
      // $team=$line[0];
      // $name=$line[1];
      // $game=$line[2];
      // $batter=$line[3];
      // $ip=$line[4];
      // $hit=$line[5];
      // $hr=$line[6];
      // $bb=$line[7];
      // $ib=$line[8];
      // $db=$line[9];
      // $so=$line[10];
      // $wild=$line[11];
      // //Calicurating FIP
      // $fip=round(((($bb*3+$hr*13)-($so*2))/$ip)+3.12,2);
      // $hr9=round(($hr/$ip)*9,2);
      // $bb9=round(($bb/$ip)*9,2);
      // $k9=round(($so/$ip)*9,2);
      // // babip(without considering sacrifice.)
      // $babip=round(($hit-$hr)/(($batter-$bb-$ib-$db)-$so-$hr),3);
      // //Autoincriment
      // $playerID=null;
      // //Designating parameters
      // $param=[
      //   'id'=>$playerID,
      //   'team'=>$team,
      //   'name'=>$name,
      //   'ip'=>$ip,
      //   'game'=>$game,
      //   'batter'=>$batter,
      //   'ip'=>$ip,
      //   'hit'=>$hit,
      //   'hr'=>$hr,
      //   'bb'=>$bb,
      //   'ib'=>$ib,
      //   'db'=>$db,
      //   'so'=>$so,
      //   'fip'=>$fip,
      //   'hr9'=>$hr9,
      //   'bb9'=>$bb9,
      //   'k9'=>$k9,
      //   'wild'=>$wild,
      //   'babip'=>$babip,
      // ];
      $param=[
        'name'=>$line[0],
        'birth_place'=>$line[1],
        'birth_date'=>$line[2],
        'height'=>$line[3],
        'weight'=>$line[4],
        'blood_type'=>$line[5],
        'pitch_rl'=>$line[6],
        'bat_rl'=>$line[7],
        'draft_year'=>(empty($line[8])) ?  0 : $line[8],
        'draft_rank'=>(empty($line[9])) ? 'none' : $line[9],
        'career'=>$line[10],
      ];
      try{
        DB::beginTransaction();
        //Inserting new record.
        DB::table('pitcher_profile')->insert($param);
        // // deleteing temp file
        // unlink($filepath); // Permittion denied error
        DB::commit();
      }catch(\Exception $e){
        DB::rollBack();
      }
    }
    return redirect('baseball_join');
  }

  public function model(Request $request){
    $items=PitchingStats::all();
    return view('baseball_model',['items'=>$items]);
  }

  public function find(Request $request){
    return view('baseball_find',['input'=>'']);
  }
  public function search(Request $request){
    // $item=PitchingStats::find($request->input);
    // $item=PitchingStats::where('name',$request->input)->first();
    // $item=PitchingStats::nameEqual($request->input)->first();
    $min=(int)$request->input * 1;
    $max=(int)$min + 10;
    $item=PitchingStats::inningGreaterThan($min)->inningLessThan($max)->first();
    $param=['input'=>$request->input,'item'=>$item];
    return view('baseball_find',$param);
  }
  
  public function joinProfileStats(){
    $items=DB::table('pitching_stats')
    // The join method create inner join
    ->join('pitcher_profile','pitching_stats.name','=','pitcher_profile.name')
    ->select('pitching_stats.*','pitcher_profile.*')->get();
    return view('baseball_join',['items'=>$items]);
  }
}
