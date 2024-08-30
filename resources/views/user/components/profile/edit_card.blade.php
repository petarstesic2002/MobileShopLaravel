<div class="col-md-4">
    <form class="p-3 py-5">
        <hr/>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-center">Card Info Settings</h4>
        </div>
        @if(count($user->user_card))
            <div class="col-md-12"><label class="labels">Current Card Number</label><input type="text" id="card" name="card" class="form-control" placeholder="{{substr($user->user_card->first()->card_number,0,4)}}xxx{{substr($user->user_card->first()->card_number,-4)}}"></div> <br>
            <div class="col-md-12"><p class="text-center alert-warning">Current Card Number needed to update info</p></div>
        @endif
        <div class="col-md-12"><label class="labels">New Card Number</label><input type="text" id="new_card" name="new_card" class="form-control" placeholder="New card number"></div> <br>
        @if(count($user->user_card))
            <div class="col-md-12"><p class="text-center alert-warning">Leave empty if updating just the date</p></div>
            <div class="col-md-12"><label class="labels">Expiry Date</label><input type="month" class="form-control" id="date" name="date" value="{{substr($user->user_card->first()->expiry_date,0,7)}}"></div>
            <div class="col-md-12"><p class="text-center alert-warning">Initial value is the expiry date of current card</p></div>
        @else
            <hr/>
            <div class="col-md-12"><label class="labels">Expiry Date</label><input type="month" class="form-control" id="date" name="date" value="{{date('Y-m')}}"></div>
            
        @endif
        <div class="mt-5 text-center">
            <button class="btn btn-primary profile-button" data-token="{{csrf_token()}}" data-id="{{$user->id}}" id="editCard" type="button">
                @if(count($user->user_card))
                    Update Card
                @else
                    Add Card
                @endif
            </button>
        </div>
    </form>
    <hr/>
    <div class="alert alert-success text-center" id="successCard" style="display:none">
    </div>
    <div class="alert alert-danger text-center" id="errorCard" style="display:none">
    </div>
</div>