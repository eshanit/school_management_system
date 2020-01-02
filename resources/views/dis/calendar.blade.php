@extends('layouts.app_dis')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <!-- Small Box (Stat card) -->
        <h5 class="mb-2 mt-4"><strong><font color='red'><i>DiS</i></font> Event's portal</strong></h5>
        <div class="row justify-content-center">
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-warning">
                    <div class="inner">
                    <h3>{{ $calendars->count() }}</h3>

                        <p>All Events</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <a href="" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>


            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-danger">
                    <div class="inner">
                    <h3>{{ $calendars_past }}<sup
                                style="font-size: 20px"></sup></h3>

                        <p>Past Events</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <span class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </span>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $calendars_present }}<sup
                                style="font-size: 20px"></sup></h3>

                        <p>Current Events</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $calendars_future }}<sup
                                    style="font-size: 20px"></sup></h3>
    
                            <p>Future Events</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="card">
            <div class="card-header">
                    <h3 class="card-title">
                            <button type="button" class="btn btn-block btn-outline-info btn-sm"
                                data-toggle="modal" data-target="#eventregistration">Register new event</button>
                    </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table id="dis_calendar" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Description</th>
                            <th scope="col">Venue & Details</th>
                            <th scope="col">Event Status</th>
                            <th scope="col">Visit Notes</th>
                            <th scope="col">Created by</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                      
                        @foreach($calendars as $calendar)
                        <tr>
                            <td align='center'>{{ $i++ }}</td>
                            @if($currentdate < $calendar->event_date)
                            <td align='center'><font color='446dff'><strong>{{ $calendar->event_date }}</strong></font></td>
                            <td align='center'><font color='446dff'><strong>Future</strong></font></td>
                            @elseif($currentdate == $calendar->event_date)
                            <td align='center'><font color='green'><strong>{{ $calendar->event_date }}</strong></font></td>
                            <td align='center'><font color='green'><strong>Present Event</strong></font></td>
                            @else
                            <td align='center'><font color='red'><strong>{{ $calendar->event_date }}</strong></font></td>
                            <td align='center'><font color='red'><strong>Past Event</strong></font></td>
                            @endif
                            <td align='center'>{{ $calendar->event_heading }}</td>
                            <td align='center'>{{ $calendar->event_description }}</td>
                            <td align='center'>{{ $calendar->event_status }}</td>
                            <td align='center'>{{ $calendar->event_notes }}</td>
                            <td align='center'><strong>{{ $user_name[$calendar->create_id] }}</strong></td>      
                            @if(Auth::user()->id == $calendar->create_id)
                            <td align='center'>
                                    <font color='orange'><span data-toggle="modal"
                                            data-target="#editeventregistration_<?php print_r($calendar->id);?>"
                                            style="cursor:pointer"><i class="fas fa-user-edit fa-lg"></i></span>
                                    </font> /
                                    <a class="delete-calendar" href="{{route('dis_calendar.destroy',[$calendar->id])}}">
                                    <font color='red'>
                                            <span style="cursor:pointer">
                                                <i class="fas fa-user-times fa-lg"></i>
                                            </span> 
                                    </font> 
                                </a>   
                                </td>
                                @else
                            <td align='center'>-</td>
                            @endif
                        </tr>
                        @endforeach
                    
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    </div>

    </div><!-- /.container-fluid -->
</section>

<!-- modal for adding event -->
<div class="modal fade" id="eventregistration" tabindex="-1" role="dialog"
        aria-labelledby="editing" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editing"><strong>
                            <font color='#96384e'>Add Event:</font>
                            </strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
    
                    <form class="form-horizontal" method="POST" action="{{ route('dis_calendar.store') }}">
                
    
                        {{ csrf_field() }}
    
                        <div class="form-group">
                                <label for="event_date">
                                    <font color="red">*</font><strong>Event Date</strong>
                                </label>
                                <input type="date" class="form-control" id="event_date" aria-describedby="" name="eventdate">
                            </div>

                        <div class="form-group">
                            <label for="Class Name">
                                <font color="red">*</font><strong>Event Description</strong>
                            </label>
                            <input type="text" class="form-control" id="event_description" aria-describedby="" placeholder="e.g Interhouse Sports" name="eventdesc">
                        </div>

                        <div class="form-group">
                                <label for="Event Details">
                                    <font color="red">*</font><strong>Venue and Details</strong>
                                </label>
                                <textarea class="form-control" id="gAddress"
                                    placeholder="e.g Event to be held for 3 days in Harare"
                                     name="eventdetails"
                                    rows="3"></textarea>
                            </div>
    
                        <button type="submit" class="btn btn-info float-right">Submit</button>
                    </form>
    
                </div>
            </div>
        </div>
    </div>
    <!--end modal-->


    <!--modal for editing caalender-->
    @foreach($calendars as $calendar)
    <div class="modal fade" id="editeventregistration_<?php print_r($calendar->id);?>" tabindex="-1" role="dialog"
    aria-labelledby="editing" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editing"><strong>
                        <font color='#96384e'>Edit Event:</font>
                        </strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="{{ route('dis_calendar.update',[$calendar->id]) }}">
            
                    {{ method_field('PUT') }}

                    {{ csrf_field() }}

                    <div class="form-group">
                            <label for="event_date">
                                <font color="red">*</font><strong>Event Date</strong>
                            </label>
                        <input type="date" class="form-control" id="event_date" aria-describedby="" placeholder="{{$calendar->event_date}}" value="{{$calendar->event_date}}"  name="eventdate">
                        </div>

                    <div class="form-group">
                        <label for="Class Name">
                            <font color="red">*</font><strong>Event Description</strong>
                        </label>
                        <input type="text" class="form-control" id="event_description" aria-describedby="" placeholder="{{$calendar->event_heading}}" value="{{$calendar->event_heading}}" name="eventdesc">
                    </div>

                    <div class="form-group">
                            <label for="Event Details">
                                <font color="red">*</font><strong>Venue and Details</strong>
                            </label>
                            <textarea class="form-control" id="gAddress"
                            placeholder="{{$calendar->event_description}}" 
                            value="{{$calendar->event_description}}"
                                 name="eventdetails"
                                rows="3"></textarea>
                        </div>

                    <button type="submit" class="btn btn-info float-right">Submit</button>
                </form>

            </div>
        </div>
    </div>
</div>

    @endforeach

    @endsection