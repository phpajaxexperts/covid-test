@isset($customFieldsData)
    <div class="table-responsive mt-5">
        @if(count($customFieldsData)>0)
            @foreach($customFieldsData as $customFieldsData)
                <strong>{{ $customFieldsData->customField->name }}</strong> : 
                @if($customFieldsData->customField->type==1 || $customFieldsData->customField->type==2)
                    {{ $customFieldsData->input_data }}
                @else
                    @php( $input_data = explode(',',$customFieldsData->input_data) )
                    @php( $strFieldValue = '' )
                    @foreach($customFieldsData->customField->fieldValues as $key => $fileValue)
                        @if(in_array($fileValue->ID,$input_data))
                            @if($strFieldValue!='')
                            @php( $strFieldValue .= ', ' )
                            @endif
                            @php( $strFieldValue .= $fileValue->value )
                        @endif
                    @endforeach
                    {{$strFieldValue}}
                @endif
                <br>
                <br>
            @endforeach
        @endif
    </div>
@endisset