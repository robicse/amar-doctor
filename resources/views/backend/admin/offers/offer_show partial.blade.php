
<div class="form-group">
    <h3>Offer for Doctor</h3>
    <!-- SEARCH FORM -->
    <ul class="list-group" style="height: 415px; overflow-y: scroll;" >
        <input type="hidden" value="{{$offer->id}}" id="offerId">
        @forelse($specialist_drs as $dr)
            <li class="list-group-item m-0 mr-2 mb-1">
                <label for="" class="m-0 p-0">
                    <input type="checkbox" class="checkbox dr_checkbox-{{$dr->id}}" name="specialist_dr_id[]"
                           id=""
                           onchange="offerAddDelete('{{$dr->id}}')"
                           value="{{$dr->id}}" {{ in_array($dr->id, $drOffers) ? 'checked' : '' }} > {{$dr->title.' '.$dr->name}}
                    <span class="badge badge-primary">  {{$dr->bmdc}} </span> <span
                        class="badge badge-primary">  {{$dr->phone}} </span>
                </label>
            </li>
        @empty
            <li class="text-center mt-5">
                <h1 class="text-info" style="font-size: 50px;"><i class="fa fa-user-md"></i> No Search Found!</h1>
              {{--  <img src="{{asset('uploads/offers/notfound.png')}}" alt="">--}}
            </li>
        @endforelse
    </ul>
</div>

