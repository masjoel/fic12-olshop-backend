<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::paginate(10);
        return view('pages.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('pages.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order = Order::where('id', $order->id);
        $order->update([
            'status' => $request->status,
            'shipping_resi' => $request->shipping_resi,
        ]);
        if ($request->status == 'on_delivery') {
            $this->sendNotificationToUser($order->first()->user_id, 'Paket Dikirim dengan nomor resi ' . $request->shipping_resi);
        }
        return redirect()->route('order.index');
    }
    public function sendNotificationToUser($userId, $message)
    {
        $user = User::find($userId);
        $token = $user->fcm_id;
        $messaging = app('firebase.messaging');
        $notification = Notification::create('Paket Dikirim', $message);
        $message = CloudMessage::withTarget('token', $token)
            ->withNotification($notification);
        $messaging->send($message);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
