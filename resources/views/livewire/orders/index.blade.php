<div>
    <div>
        @include('livewire.orders.create')
        @include('livewire.orders.edit')
        @include('livewire.orders.delete')
        <div class="card">
            <div class="card-header d-flex">
                <h3 class="text-center fw-bold mt-3" style="font-family: Fantasy;">Shoes</h3>
                <div class="d-flex ms-auto input-group w-50">
                    <a data-bs-toggle="modal" data-bs-target="#orderModal" class="ms-auto mt-3 btn btn-primary">
                        Add
                    </a>
                </div>
            </div>
    <div class="card-body table-responsive">
        @role('admin')
        <div class="col-sm-6 mb-3 ms-auto d-flex">
            <select class="form-select" name="users" wire:model.lazy="store">
                <option value="all">All</option>
                <option value="Alturas">Alturas</option>
                <option value="ICM">ICM</option>
                <option value="SM">SM</option>
                <option value="Ayala">Ayala</option>
            </select>
            <input type="search" wire:model="search" class="form-control float-end mt-1 ms-2" placeholder="Search..." />
        </div>
        @endrole
        <table id="example1" class="table table-borderd table-sm table-hover">
            <thead class="text-center table-primary">
                <tr >
                    <th>ID</th>
                    <th>Brand</th>
                    <th>Quantity</th>
                    <th>Size</th>
                    <th>Store</th>
                    <th>Delivery Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @role('admin')
                @foreach ( $orders as $order)
                <tr class="text-center">
                    <td class="text-center">{{$order->id}}</td>
                    <td class="text-center">{{$order->brand}}</td>
                    <td class="text-center">{{$order->quantity}}</td>
                    <td class="text-center">{{$order->size}}</td>
                    <td class="text-center">{{$order->store}}</td>
                    <td class="text-center">{{$order->delivery_date}}</td>
                    <td> <a type="button" data-bs-toggle="modal" data-bs-target="#updateorderModal" class="btn btn-primary" wire:click="editOrder({{$order->id}})">
                        Edit</a>
                        <a type="button" data-bs-toggle="modal" class="btn btn-danger" data-bs-target="#deleteorderModal" wire:click="deleteOrder({{$order->id}})">
                            Delete</a>
                </td>
                </tr>
                @endforeach
                @endrole
                @role('user')
                @foreach ( $orders as $order)
                @if($order->user_id == auth()->id())
                <tr>
                    <td class="text-center">{{$order->id}}</td>
                    <td class="text-center">{{$order->brand}}</td>
                    <td class="text-center">{{$order->quantity}}</td>
                    <td class="text-center">{{$order->size}}</td>
                    <td class="text-center">{{$order->store}}</td>
                    <td class="text-center">{{$order->delivery_date}}</td>
                    <td> <a type="button" data-bs-toggle="modal" class="btn btn-primary" data-bs-target="#updateorderModal" wire:click="editOrder({{$order->id}})">
                        Edit</a>
                        <a type="button" data-bs-toggle="modal" class="btn btn-danger" data-bs-target="#deleteorderModal" wire:click="deleteOrder({{$order->id}})">
                            Delete</a>
                </td>
                </tr>
                @endif
                @endforeach
                @endrole
            </tbody>

        </table>
    </div>
    </div>
    </div>
</div>
