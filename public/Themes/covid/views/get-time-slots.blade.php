<div id="tabs_hop" class="tabs_hop">
<ul>
@php( $hours_of_operations = getHoursOfOperation($centerID) )
    @for ($i = 1; $i <= 5; $i++)
        @php( $cur_date_timestamp = time() + 86400 * $i )
        @if(count($hours_of_operations)>0)
            @foreach($hours_of_operations as $hours_of_operation)
                @if($hours_of_operation->all_day_close!=1 && strtolower(date('l',$cur_date_timestamp))==strtolower($hours_of_operation->day_name) && $hours_of_operation->open!='' && $hours_of_operation->close!='')
                    <li style="font-size: 13px;"><a href="#tab_hoo_{{$centerID}}_{{$i}}"><span>{{date("M d, Y", $cur_date_timestamp)}}</span></a></li>
                    @break
                @endif
            @endforeach
        @endif
    @endfor
</ul>
</div>
<div id="tab_hop_container">
@for ($i = 1; $i <= 5; $i++)
    @php( $cur_date_timestamp = time() + 86400 * $i )
    @if(count($hours_of_operations)>0)
        @foreach($hours_of_operations as $hours_of_operation)
            @if($hours_of_operation->all_day_close!=1 && strtolower(date('l',$cur_date_timestamp))==strtolower($hours_of_operation->day_name) && $hours_of_operation->open!='' && $hours_of_operation->close!='')
                <div id="tab_hoo_{{$centerID}}_{{$i}}" style="overflow-y: auto;">
                    {{--{{$hours_of_operation->open}} - {{$hours_of_operation->close}}--}}
                    @php( $difference = round(abs(strtotime($hours_of_operation->open) - strtotime($hours_of_operation->close)) / 3600,2) )
                    @php( $start_time = date('h:i a',strtotime($hours_of_operation->open)))
                    @for ($j = 1; $j <= $difference; $j++)
                        <div class="row mb-2">
                            @for ($k = 1; $k <= $center->slots_per_hour; $k++)
                                @php( $time_slots = strtotime($start_time) + ((60/$center->slots_per_hour)*60))
                                @php( $cur_time_slot = date('Y-m-d H:i',strtotime(date('Y-m-d',$cur_date_timestamp).' '.$start_time)) )
                                {{--@php( $booked_patients_count_in_slot = getBookedPatientsCountInSlot($cur_time_slot,$centerID) )--}}
                                @php( $res = searchForBookingTime($cur_time_slot, $selected_time_slots) )
                                @if($res['status']=='yes')
                                    @if($selected_time_slots[$res['key']]['booking_count']>=$center->patients_per_slot)
                                        @php( $booked = 'yes' )
                                    @else
                                        @php( $booked = 'no' )
                                    @endif
                                @else
                                    @php( $booked = 'no' )
                                @endif
                                <div class="card text-center pointer bm-card timeslot @if($booked=='yes') slot_booked @endif">
                                    <div class="card-body p-2">
                                        <a href="javascript:void(0);" @if($booked=='no') onclick="$('.card').removeClass('selected');$(this).parents('.card').addClass('selected'); selectedDateTime('{{date('Y-m-d',$cur_date_timestamp).' '.$start_time}}','{{date('d/m/Y',$cur_date_timestamp)}}','{{date('h:i A',strtotime($start_time)).' - '.date('h:i A',$time_slots)}}')" @endif >{{$start_time}} - {{date('h:i a',$time_slots)}}</a>
                                    </div>
                                </div>
                                @php( $start_time = date('h:i a',$time_slots))
                            @endfor
                        </div>
                    @endfor
                </div>
                @break
            @endif
        @endforeach
    @endif
@endfor
</div>