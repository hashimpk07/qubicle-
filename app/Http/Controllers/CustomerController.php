<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon;
use App\Models\CustomerDetails;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $referralCodes  = Customer::all('id', 'referral_code');
        return view('customer.login', ['referralCodes' => $referralCodes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $input     = $request->all();
        $today     = Carbon\Carbon::now();

        $validatedData = $request->validate([
            'name'          => 'required',
            'email'       => 'required|email|unique:customers',
        ]);

        $aData['customerName']     = $input['name'];
        $aData['customerEmailId']  = $input['email'];
        if( 0 == $input['referralCode'] || '' == $input['referralCode'] ){
            $result  = $this->storeData($aData);
        }else{
            $refferenceCode = $input['referralCode'];
            $customersRefference = DB::table('customer_details')
                      ->select('level','points' )->where('customers_id', '=',$refferenceCode )->get();
            if(!empty($customersRefference)){
                $customefrsReference  = $customersRefference[0];
                if( 10 == $customefrsReference->level || 0 == $customefrsReference->points ){
                    $result  = $this->storeData($aData);
                }else{
                    $aLevel  = explode(' ', $customefrsReference->level);
                    if(!empty($aLevel)){
                        $dlevel = $aLevel[1] + 1;
                        $level = 'Level '.$dlevel;
                    }
                    $points = $customefrsReference->points - 1;
                    $result  = $this->storeData($aData,$points,$level);
                }
            }else{
                return response()->json(['status'=>'error','message' => 'invalid Refference Code']);
            }
        }
        if( 1 != $result ){
            return response()->json(['status'=>'success','message' => $result]);
        }else{
            return response()->json(['status'=>'error','message' => 'invalid Refference Code']); 
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeData($aData, $points = 10, $level = 'Level 1')
    {
        $today     = Carbon\Carbon::now();

        $data = new Customer;
        $data->name   = $aData['customerName'];
        $data->email  = $aData['customerEmailId'];
        $data->created_at = $today;
        $data->created_at = $today;

        $data->save();
        $customerId    = $data->id;
        if( 0 != $customerId ){
            $referralCode  = $this->generateReferralCode($customerId);
                
            $details = new CustomerDetails;
            $details->customers_id  =  $customerId;
            $details->level         =  $level;
            $details->points        =  $points;
            $details->created_at    =  $today;
            $details->created_at    =  $today;

            $details->save();$aUpdate     = [
                'referral_code'    =>  $referralCode,    
            ];
            $customers = DB::table('customers')
                ->where('id', $customerId)
                ->update($aUpdate);

            return $referralCode;
        }else{
            return 0;
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generateReferralCode($id,$length = 10) {
        $random =  substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
       return 'Qubi'.$id.$random;
    }


}
