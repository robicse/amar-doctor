<link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
<style>
    th {
        color: #212529;
    }
</style>
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel"><b>Withdrawals Details</b></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <table id="modalTbl" class="table table-bordered table-striped">

        <tr>
            <th>Name</th>
            <td>{{$withdraw_details->user->name}}</td>
        </tr>
        <tr>
            <th>TRX</th>
            <td>{{$withdraw_details->trx}}</td>
        </tr>
        <tr>
            <th>Amount</th>
            <td><span style="font-size: 20px;">৳</span>{{$withdraw_details->amount}}</td>
        </tr>
        <tr>
            <th>Charge</th>
            <td><span style="font-size: 20px;">৳</span>{{$withdraw_details->charge}}</td>
        </tr>
        <tr>
            <th>Final amount</th>
            <td><span style="font-size: 20px;">৳</span>{{$withdraw_details->final_amount}}</td>
        </tr>

        @php
            $withdraw_information =  json_decode($withdraw_details->withdraw_information);
    //dd($withdraw_information)
        @endphp
        @if($withdraw_information->type == 'bank_info')

            <tr>
                <th>type</th>
                <td>@if( $withdraw_information->type =='bank_info' ) Bank @endif</td>
            </tr>
            <tr>
                <th>Bank Name</th>
                <td>{{$withdraw_information->bank_name}}</td>
            </tr>
            <tr>
                <th>Branch Name</th>
                <td>{{$withdraw_information->branch_name}}</td>
            </tr>
            <tr>
                <th>Account Holder Name</th>
                <td>{{$withdraw_information->acc_holder_name}}</td>
            </tr>
            <tr>
                <th>Account Number</th>
                <td>{{$withdraw_information->account_number}}</td>
            </tr>
{{--            <tr>--}}
{{--                <th>Routing Number</th>--}}
{{--                <td>{{$withdraw_information->routing_number}}</td>--}}
{{--            </tr>--}}
            <tr>
                <th>FeedBack</th>
                <td>{{$withdraw_details->admin_feedback}}</td>
            </tr>
        @else
            <tr>
                <th>type</th>
                <td>@if( $withdraw_information->type =='mob_banking' ) Mobile Banking @endif</td>
            </tr>
            <tr>
                <th>Company</th>
                <td>{{$withdraw_information->provider}}</td>
            </tr>
            <tr>
                <th>Number</th>
                <td>{{$withdraw_information->number}}</td>
            </tr>
            <tr>
                <th>FeedBack</th>
                <td>{{$withdraw_details->admin_feedback}}</td>
            </tr>
        @endif

    </table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<script src="{{asset('backend/plugins/datatables/jquery.dataTables.js')}}"></script>
