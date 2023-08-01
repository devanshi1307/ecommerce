<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\mail\InvoiceOrderMaileable;
use App\Models\Order;
// use Carbon\Carbon;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Support\Facades\Mail;
use Mockery\Expectation;
use Termwind\Components\Raw;
class OrderController extends Controller
{
    public function index(Request $request)
    {
        // $todayDate = Carbon::now();
        // $orders = Order::whereDate('created_at',$todayDate)->get();
        
        $todayDate = Carbon::now()->format('y-m-d');
        $orders = Order::when($request->date !=null, function($q) use($request) {

                      return  $q->whereDate('created_at',$request->date);
                    }, function($q) use($todayDate){

                        return  $q -> whereDate('created_at',$todayDate);

                      })
                    ->when($request->status !=null, function($q) use($request) {

                        return  $q->where('status_message',$request->status);

                      })
                    
                    ->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(int $orderId)
    {
        
        $order = Order::where('id',$orderId)->first();
        if($order)
        {
            return view('admin.orders.view', compact('order'));
        }
        else
        {
            return redirect('admin/orders')->with('message','Id not fount');
        }
    }

    public function updateOrderStatus(int $orderId, Request $request)
    {
        
        $order = Order::where('id',$orderId)->first();
        if($order)
        {
            $order->update([
                'status_message' =>$request->order_status
            ]);
           return redirect('admin/orders'.$orderId)->with('message','Order status update');
        }
        else
        {
            return redirect('admin/orders'.$orderId)->with('message','Id not fount');
        }
    }

    public function viewInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('admin.invoice.generate-invoice', compact('order'));

    }

    public function generateInvoice($orderId)
    { $order = Order::findOrFail($orderId);
        $data= ['order' => $order];
        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);

        $todayDate=Carbon::now()->format('d-m-y');
        return $pdf->download('invoice-'.$order->id.'-'.$todayDate.'.pdf');
    }  
    
    

    public function mailInvoice(int $orderId)
    {
        try
        { 
            $order = Order::findOrFail($orderId);
            Mail::to($order->email)->send(new InvoiceOrderMaileable($order));
            // Mail::to("$order->email")->send(new InvoiceOrderMaileable($order));
            return redirect('/admin/orders/'.$orderId)->with('message','message of invoice has been sent'.$order-> email);
            
            
        }
        catch(\Exception $e){
            return redirect('/admin/orders/'.$orderId)->with('message','Something went wrong');

      
    }

}
}
