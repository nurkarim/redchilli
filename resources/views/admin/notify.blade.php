  <div class="dropdown-item noti-title">
                                    <h5><small><span class="label label-danger pull-xs-right">{{count($notifys)}}</span>Allerts</small></h5>
                                </div>
@if(count($notifys) > 0)

@foreach($notifys as $notify)
<a href="#" class="dropdown-item notify-item">
                                    <div class="notify-icon ">
                                    <i class="fa fa-bell-o"></i>
                                    </div>
                                    <p class="notify-details" title="{{ $notify->note }}">
                                        <b>{{ $notify->customer }}</b>
                                        <span>{{ $notify->note }}</span>
                                        <small class="text-muted">{{ date("H:m A", strtotime($notify->created_at)) }}</small>
                                    </p>
                                </a>
                                @endforeach
                                <script type="text/javascript">
                                	var audio = new Audio('{{url('public/audio/board.mp3')}}');
audio.play();
                                </script>
                                @endif
                                     <!-- All-->
                                <a href="#" class="dropdown-item notify-item notify-all">
                                    View All Allerts
                                </a>
