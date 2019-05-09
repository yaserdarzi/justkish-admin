@extends('layouts.pages')
@section('title')
    @if(isset($editValue))
        {{'ویرایش عرضه کننده'}}
    @else
        {{'افزودن عرضه کننده'}}
    @endif
@endsection
@section('content')
    <!-- Page Header -->
    <form method="POST"
          action="{{url('products/'.$product_id.'/episode')}}@if(isset($editValue))/{{$editValue->id}}@endif"
          files="true" enctype="multipart/form-data">
        {!! csrf_field() !!}
        @if(isset($editValue))
            <input type="hidden" name="_method" value="PATCH">
        @endif
        <header class="page-header">
            <div class="content">
                <div class="title">
                    @if(isset($editValue))
                        <h1> ویرایش عرضه کننده </h1>
                    @else
                        <h1> افزودن عرضه کننده </h1>
                    @endif
                </div>
                <div class="functions">
                    <button onclick="location.href='{{url('products/'.$product_id.'/episode')}}';"
                            type="button"
                            class="white"> بازگشت
                    </button>
                    @if(isset($editValue))
                        <button class="purple"> ویرایش</button>
                    @else
                        <button class="purple"> انتشار</button>
                    @endif
                </div>
            </div>
        </header>
        <div class="main-content">
            <div class="row">
                @if(Session::get('success')!=null)
                    <div class="alert alt green">
                        <p>{{Session::get('success')}}</p>
                        <a href="#" class="icon-close alert-close "></a>
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alt red">
                        <p>{{$errors->first()}}</p>
                        <a href="#" class="icon-close alert-close "></a>
                    </div>
                @endif
                <div class="col-sm-12">
                    <!-- Form General -->
                    <section class="panel form-general">
                        <article>
                            <ul class="tabs-contents">
                                <li id="tab-lang-fa">
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="start_date"><span class="icon-map-pin"></span>تاریخ شروع</label>
                                            <input type="text" id="start_date">
                                            <input type="text" id="start_date_val" name="start_date" hidden>
                                        </div>
                                    </div>
                                    <div class="form-title" style="@if(isset($editValue)){{'display: none;'}}@endif">
                                        <div class="field">
                                            <label for="end_date"><span class="icon-map-pin"></span>تاریخ پایان</label>
                                            <input type="text" id="end_date">
                                            <input type="text" id="end_date_val" name="end_date" hidden>
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="capacity"><span class="icon-map-pin"></span> ظرفیت</label>
                                            <input type="text" id="capacity" name="capacity" placeholder="ظرفیت"
                                                   onkeypress="return onlynumber(event);"
                                                   value="{{old('capacity')}}@if(isset($editValue)){{$editValue->capacity}}@endif"
                                                   class="title lg">
                                        </div>
                                    </div>
                                    @if($productInfo->time_limitation)
                                        <div class="form-title">
                                            <div class="field">
                                                <label for="start_hours"><span class="icon-map-pin"></span> شروع
                                                    ساعت</label>
                                                <input type="text" id="start_hours" name="start_hours"
                                                       placeholder="شروع ساعت"
                                                       onkeypress="return onlynumber(event);" maxlength="2"
                                                       value="{{old('start_hours')}}@if(isset($editValue)){{$editValue->start_hours}}@endif"
                                                       class="title lg">
                                            </div>
                                        </div>
                                        <div class="form-title">
                                            <div class="field">
                                                <label for="end_hours"><span class="icon-map-pin"></span> شروع
                                                    ساعت</label>
                                                <input type="text" id="end_hours" name="end_hours"
                                                       placeholder="شروع ساعت"
                                                       onkeypress="return onlynumber(event);" maxlength="2"
                                                       value="{{old('end_hours')}}@if(isset($editValue)){{$editValue->end_hours}}@endif"
                                                       class="title lg">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-title">
                                        <div class="field">
                                            <label for="status"><span class="icon-map-pin"></span> وضعیت</label>
                                            <div class="select">
                                                <select id="status" name="status">
                                                    <option @if(isset($editValue)) @if($editValue->status==1){{'selected'}}@endif @else @if(old('status')==1){{'selected'}}@endif  @endif value="1">
                                                        فعال
                                                    </option>
                                                    <option @if(isset($editValue)) @if($editValue->status==0){{'selected'}}@endif @endif value="0">
                                                        غیر فعال
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </article>
                    </section>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('files/web/css/persian-datepicker.css')}}"/>
@endsection
@section('script')
    <script src="{{asset('files/web/js/persian-date.js')}}"></script>
    <script src="{{asset('files/web/js/persian-datepicker.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            let start_date = $("#start_date").persianDatepicker(
                {
                    "inline": false,
                    "format": "L",
                    "viewMode": "day",
                    "initialValue": true,
                    "minDate": null,
                    "maxDate": null,
                    "autoClose": true,
                    "position": "auto",
                    "altFormat": "unix",
                    "altField": "#start_date_val",
                    "onlyTimePicker": false,
                    "onlySelectOnDate": false,
                    "calendarType": "persian",
                    "inputDelay": 800,
                    "observer": false,
                    "calendar": {
                        "persian": {
                            "locale": "fa",
                            "showHint": false,
                            "leapYearMode": "algorithmic"
                        },
                        "gregorian": {
                            "locale": "en",
                            "showHint": true
                        }
                    },
                    "navigator": {
                        "enabled": true,
                        "scroll": {
                            "enabled": true
                        },
                        "text": {
                            "btnNextText": "<",
                            "btnPrevText": ">"
                        }
                    },
                    "toolbox": {
                        "enabled": true,
                        "calendarSwitch": {
                            "enabled": true,
                            "format": "MMMM"
                        },
                        "todayButton": {
                            "enabled": true,
                            "text": {
                                "fa": "امروز",
                                "en": "Today"
                            }
                        },
                        "submitButton": {
                            "enabled": true,
                            "text": {
                                "fa": "تایید",
                                "en": "Submit"
                            }
                        },
                        "text": {
                            "btnToday": "امروز"
                        }
                    },
                    "timePicker": {
                        "enabled": false,
                        "step": 1,
                        "hour": {
                            "enabled": true,
                            "step": null
                        },
                        "minute": {
                            "enabled": true,
                            "step": null
                        },
                        "second": {
                            "enabled": true,
                            "step": null
                        },
                        "meridian": {
                            "enabled": true
                        }
                    },
                    "dayPicker": {
                        "enabled": true,
                        "titleFormat": "YYYY MMMM"
                    },
                    "monthPicker": {
                        "enabled": true,
                        "titleFormat": "YYYY"
                    },
                    "yearPicker": {
                        "enabled": true,
                        "titleFormat": "YYYY"
                    },
                    "responsive": true
                }
            );
            @if(isset($editValue))
            start_date.setDate({{$editValue->start_date.'000'}});
                    @endif
            let end_date = $("#end_date").persianDatepicker(
                {
                    "inline": false,
                    "format": "L",
                    "viewMode": "day",
                    "initialValue": true,
                    "minDate": null,
                    "maxDate": null,
                    "autoClose": true,
                    "position": "auto",
                    "altFormat": "unix",
                    "altField": "#end_date_val",
                    "onlyTimePicker": false,
                    "onlySelectOnDate": false,
                    "calendarType": "persian",
                    "inputDelay": 800,
                    "observer": false,
                    "calendar": {
                        "persian": {
                            "locale": "fa",
                            "showHint": false,
                            "leapYearMode": "algorithmic"
                        },
                        "gregorian": {
                            "locale": "en",
                            "showHint": true
                        }
                    },
                    "navigator": {
                        "enabled": true,
                        "scroll": {
                            "enabled": true
                        },
                        "text": {
                            "btnNextText": "<",
                            "btnPrevText": ">"
                        }
                    },
                    "toolbox": {
                        "enabled": true,
                        "calendarSwitch": {
                            "enabled": true,
                            "format": "MMMM"
                        },
                        "todayButton": {
                            "enabled": true,
                            "text": {
                                "fa": "امروز",
                                "en": "Today"
                            }
                        },
                        "submitButton": {
                            "enabled": true,
                            "text": {
                                "fa": "تایید",
                                "en": "Submit"
                            }
                        },
                        "text": {
                            "btnToday": "امروز"
                        }
                    },
                    "timePicker": {
                        "enabled": false,
                        "step": 1,
                        "hour": {
                            "enabled": true,
                            "step": null
                        },
                        "minute": {
                            "enabled": true,
                            "step": null
                        },
                        "second": {
                            "enabled": true,
                            "step": null
                        },
                        "meridian": {
                            "enabled": true
                        }
                    },
                    "dayPicker": {
                        "enabled": true,
                        "titleFormat": "YYYY MMMM"
                    },
                    "monthPicker": {
                        "enabled": true,
                        "titleFormat": "YYYY"
                    },
                    "yearPicker": {
                        "enabled": true,
                        "titleFormat": "YYYY"
                    },
                    "responsive": true
                }
                );
            @if(isset($editValue))
            end_date.setDate({{$editValue->end_date.'000'}});
            @endif
        });
    </script>
@endsection
