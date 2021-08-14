<form>
    <input type="hidden" wire:model="selected_id">
    <div class="row ">
        <div class="col-sm-6 pt-3">
            <label for="">Name:</label>
            <input type="text" class="form-control" placeholder="Example food,salary,shopping" wire:model="name"
                required>
        </div>
        <div class="col-sm-6 pt-3">
            <label for="">Amount:</label>
            <input type="number" class="form-control" placeholder="amount" wire:model="amount">
        </div>
        <div class="col-sm-12">
            <button type="submit" class="btn btn-outline-info w-100 mt-3 mb-3" onclick="{{$this->model='false'}}"
              @if (!$module)
              wire:click.prevent="updateincome()"
              @else
              wire:click.prevent="updateexpesne()"
              @endif >Update
                Amount</button>
        </div>
    </div>
</form>
