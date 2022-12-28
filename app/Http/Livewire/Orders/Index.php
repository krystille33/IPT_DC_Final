<?php

namespace App\Http\Livewire\Orders;

use App\Models\Shoe;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $search, $store="all";
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function loadOrders(){
        $query = Shoe::orderBy('brand')
            ->search($this->search);

        if($this->store != 'all'){
            $query->where('store', $this->store);

        }
        $orders = $query->paginate(5);
        return compact('orders');
    }
    public function closeModal()
    {
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function back(){
        return redirect('/admin/orders/');
    }

    public function resetInput()
    {
        $this->brand = '';
        $this->quantity = '';
        $this->size = '';
        $this->store = '';
        $this->delivery_date = '';
    }
    public $brand, $quantity, $size, $delivery_date, $user_id;

    public function addOrder(){
        $this->validate([
            'brand' => ['required', 'string'],
            'quantity' => ['required', 'string'],
            'size' => ['required', 'string'],
            'store' => ['required', 'string'],
            'delivery_date' => ['required', 'string'],
        ]);

        $order = Shoe::create([
            'user_id' => auth()->id(),
            'brand' => $this->brand,
            'quantity' => $this->quantity,
            'size' => $this->size,
            'store' => $this->store,
            'delivery_date' => $this->delivery_date,
        ]);
        return redirect()->to('/admin/orders');
        session()->flash('message','order Added Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function updateOrder(){
        $this->validate([
            'brand' => ['required', 'string'],
            'quantity' => ['required', 'string'],
            'size' => ['required', 'string'],
            'store' => ['required', 'string'],
            'delivery_date' => ['required', 'string'],
        ]);
        $order = Shoe::findOrFail($this->order_id);
        $order->where('id',$this->order_id)->update([
            'brand' => $this->brand,
            'quantity' => $this->quantity,
            'size' => $this->size,
            'store' => $this->store,
            'delivery_date' => $this->delivery_date,
        ]);
        return redirect()->to('/admin/orders');
        session()->flash('message','Order Updated Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editOrder(int $order_id){
        $order = Shoe::find($order_id);
        if($order){
            $this->order_id = $order->id;
            $this->brand = $order->brand;
            $this->quantity = $order->quantity;
            $this->size = $order->size;
            $this->store = $order->store;
            $this->delivery_date = $order->delivery_date;
        }else{
            return redirect()->to('/admin/orders');
        }
    }
    public function deleteOrder(int $order_id)
    {
        $this->order_id = $order_id;
    }

    public function destroyOrder()
    {
        Shoe::find($this->order_id)->delete();
        session()->flash('message','order Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
       $users = User::get();
        return view('livewire.orders.index', compact('users'), $this->loadOrders());
    }
}
