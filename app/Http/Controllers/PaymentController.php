<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use SimpleXMLElement;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::all();
        return view('payment.index')->with("payments", $payments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['xmltext'=>'required']);
        $xml = $request->get('xmltext');

        $PAYMENTS = new SimpleXMLElement($xml);

        foreach ($PAYMENTS->children() as $payment) {
            $temp = new Payment();
            $temp->sid = $PAYMENTS->attributes()->SID;
            $temp->dob = $PAYMENTS->attributes()->DOB;
            $temp->store_code = $PAYMENTS->attributes()->STORECODE;
            $temp->store_name = $PAYMENTS->attributes()->STORENAME;
            $temp->tender = $payment->TENDER;
            $temp->check_payments = $payment->CHECK;
            $temp->card = $payment->CARD;
            if($payment->EXP == '' || $payment->EXP == null)
                $temp->exp = 0;
            else
                $temp->exp = $payment->EXP;
            $temp->qty = $payment->QTY;
            $temp->amount = $payment->AMOUNT;
            $temp->total = $payment->TOTAL;
            $temp->empployee_name = $payment->EMPPLOYEENAME;
            $temp->empployee_id = $payment->EMPPLOYEEID;

            $temp->save();
        }

        return redirect()->route('payment.index')->with('success','Payment created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Payment::find($id)->delete;
        return redirect()->route('payment.index')->with('success','Payment dropped.');
    }
}