<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <link href="https://fonts.maateen.me/kalpurush/font.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,600;1,700&family=Noto+Sans+Bengali:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.maateen.me/kalpurush/font.css');
        @font-face {
            font-family: 'Kalpurush', sans-serif;
            src: url({{ storage_path('fonts/kalpurush.ttf') }}) format('truetype');
        }
        *{
            font-size: 12px;
            font-family: 'Montserrat', sans-serif;
            font-family: 'Kalpurush', sans-serif;
            /*font-family: "Kalpurush", DejaVu Sans;*/
        }
        table, th, td {
            border-collapse: collapse;
        }
        th, td {
            padding: 2px;
        }
        th {
            text-align: left;
        }
        .vl {
            border-left: 2px solid grey;
            height: 1020px;
            position: relative;
            left: 30%;
            margin-left: -3px;
            margin-top: -10px;


        }
        .medicine{

          position: relative;
            margin-top: -1000px;
        }
        .signature p{
            margin: 0px;

        }
    </style>
</head>
<body>
<table style="width:100%">
    <tr>
        <th><h3>{{$prescription->SpecialistDr->title}}{{$prescription->SpecialistDr->user->name}}</h3></th>
        <th style="text-align: right">Date: {{date('d F Y H:i:s A', strtotime($prescription->created_at))}} </th>
    </tr>
    <tr>
        <td>{{$prescription->SpecialistDr->professional_derees}}</td>
    </tr>
    @php
        $specialities = \App\Model\DrSpecialist::where('specialist_dr_id',$prescription->SpecialistDr->id)->get();
            //dd($specialities);
    @endphp
    <tr>

        <td>   @foreach($specialities as $specialitie)
                {{$specialitie->speciality->name}}.
            @endforeach
        </td>
    </tr>
    <tr>
        <td>{{$prescription->SpecialistDr->current_employment}}</td>
    </tr>
    <tr>
        <td>BMDC {{$prescription->SpecialistDr->bmdc}}</td>
    </tr>
</table>
<hr>
<table style="width:100%">
    <tr>
        <th><b>Patient Name</b> : {{$prescription->patient->name}}</th>
        <th><b>Gender:</b> {{$prescription->patient->gender}}</th>
        <th><b>Weight:</b> {{$prescription->patient->weight}}KG</th>
        <th><b>Age:</b> {{$prescription->patient->age_year}}.{{$prescription->patient->age_month}}Y</th>

    </tr>
</table>

<hr>
<div class="p-body" >
    <div class="advice" style="width: 30%;float: left">
        @if(!empty($prescription->symptoms))
            <p><b>Chief Complaints</b></p>
            <ul >
                <li>{{$prescription->symptoms}}</li>
            </ul>
        @endif

        @if(!empty($prescription->tests))
            <p> <b>Test</b></p>
            <ul>
                <li>{{$prescription->tests}}</li>

            </ul>
        @endif
        @if(!empty($prescription->advice))
            <p><b>Advice</b></p>
            <ul >
                <li>{{$prescription->advice}}</li>

            </ul>
        @endif
        @if(!empty($prescription->follow_up_within))
            <p><b>Follow-up Within</b></p>
            <ul>
                <li>{{$prescription->follow_up_within }}</li>

            </ul>
        @endif
    </div>

    <div class="vl"></div>

    <div class="medicine"style="width: 68%;float: right">
        <b><span>R<sub>x</sub></span> </b>

        @php $medicines = json_decode($prescription->medicine_details);
                                    //dd($medicine);
        @endphp
        @foreach($medicines as $key => $medicine)
            <ol style="margin-bottom: -11px; list-style-type: none;">
                <li> {{$key+1}}. {{$medicine->medicine}}
                    <p>{{$medicine->take_time}} <span style="margin-left: 20px;">{{$medicine->isMeal}}</span><span style="margin-left: 20px;"> {{$medicine->till}}</span><span style="margin-left: 20px;"> {{$medicine->custome_instruction}}</span></p>
                </li>

            </ol>
             <hr>
        @endforeach
{{--        <div class="signature" style=";margin-top: 538px;">--}}
{{--            <hr style="margin-bottom: -10px">--}}
{{--            <br>--}}
{{--            <p><b>{{$prescription->SpecialistDr->title}}{{$prescription->SpecialistDr->user->name}}</b></p>--}}
{{--            <p>{{$prescription->SpecialistDr->professional_derees}}</p>--}}
{{--            <p>ENT Specialist,General Physician,Covid Unit</p>--}}
{{--            <p>{{$prescription->SpecialistDr->current_employment}}</p>--}}

{{--        </div>--}}
    </div>


</div>
<div class="p-footer">

        <div class="signature" style="width: 68%;float: right;margin-top: 710px">
            <hr style="margin-bottom: -10px">
            <br>
            <p><b>{{$prescription->SpecialistDr->title}}{{$prescription->SpecialistDr->user->name}}</b></p>
            <p>{{$prescription->SpecialistDr->professional_derees}}</p>
            {{--            <p>ENT Specialist,General Physician,Covid Unit</p>--}}
            <p>{{$prescription->SpecialistDr->current_employment}}</p>
            <img width="15%" height="15px" src="{{asset('uploads/signature/'. $prescription->SpecialistDr->signature)}}" alt="">
        </div>

</div>


{{--<a class="btn btn-info waves-effect" href="{{route('admin.prescription.download',$prescription->id)}}"> download </a>--}}
</body>
</html>
