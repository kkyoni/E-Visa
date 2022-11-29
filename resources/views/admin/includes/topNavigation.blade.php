<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary bars" href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to {{Settings::get('project_title')}} Admin Penal.</span>
                </li>
                @php
                $inquiryPermission = \App\Helpers\Helper::checkPermission(['inquiry-list']);
                @endphp
                @if($inquiryPermission)
                @php
                $contact = App\ContactUs::where('admin_read','unread')->limit(5)->get();
                $contact_count = App\ContactUs::where('admin_read','unread')->get()->count();
                @endphp
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">{{$contact_count}}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        @if($contact->count() > 0)
                        @foreach($contact as $contact_list)
                        <li>
                            <div class="dropdown-messages-box">
                                <div class="media-body ">
                                    <small class="float-right">
                                        {{ $contact_list->created_at->diffForHumans() }} 
                                    </small>
                                    <strong>{{$contact_list->name}}</strong> {!! Str::words($contact_list->message, $words = 10, $end = '...') !!} <br>
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($contact_list->created_at)->format('H.i A')}}
                                        {{ \Carbon\Carbon::parse($contact_list->created_at)->format('d.m.Y')}}
                                    </small>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-divider"></li>
                        @endforeach
                        @endif   
                        <li>
                            <div class="text-center link-block">
                                <a href="{{ route('admin.inquiry') }}" class="dropdown-item">
                                    <i class="fa fa-envelope"></i> <strong>Read All Inquiry</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                @endif
        <li>
            @if(!empty(Auth::user()->avatar))
            <img class="rounded-circle" src="{!!  \Auth::user()->avatar !== '' ? asset("storage/avatar/".\Auth::user()->avatar) : asset('storage/avatar/default.png') !!}" alt="user-img" height="60px" width="60px">
            @else
            <img class="rounded-circle" src="{!! asset('storage/avatar/default.png') !!}" alt="user-img" accept="image/*" height="60px" width="60px">
            @endif
        </li>
        <li>
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span class="block m-t-xs font-bold">{{  \Auth::user()->name }}<b class="caret"></b></span>
            </a>
            <ul class="dropdown-menu animated fadeInLeft m-t-xs">
                <li><a class="dropdown-item" href="{{ route('admin.profile') }}">Profile</a></li>
                <li class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a></li>
            </ul>
        </li>
        <li>
            <a class="right-sidebar-toggle" style="color: #212529;"><i class="fa fa-tasks"></i></a>
        </li>
        </ul>
    </nav>
</div>
<div id="right-sidebar" class="animated" style="color: #212529;">
    <div class="sidebar-container">
        <ul class="nav nav-tabs navs-3">
            <li><a class="nav-link " data-toggle="tab" href="#tab-1"> <i class="fa fa-gear"></i></a></li>
        </ul>
        <div class="tab-content">
            <div id="tab-1" class="tab-pane active">
                <div class="sidebar-title">
                    <h3><i class="fa fa-gears"></i> Settings</h3>
                    <small><i class="fa fa-tim"></i> You have Reference site about completed.</small>
                </div>
                @if(Auth::user()->user_type == 'superadmin')
                <div class="setings-item">
                    <span>Maintenance <code>.Mode</code></span>
                    <div class="switch">
                        <div class="onoffswitch">
                            <input type="checkbox"  class="onoffswitch-checkbox" id="example1" <?php $site = \App\SiteSetting::where(['id' => '1'])->value('meta_value'); if($site == '1'){ echo "checked"; }else{ } ?> name="site_maintenance">
                            <label class="onoffswitch-label" for="example1">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                </div>
                @endif
                <div class="setings-item">
                    <span>Language <code>.Site</code></span>
                    <div id="google_translate_element" style="width: 10px; height: 10px; float: right; margin-right: 100px;"></div>
                    <script type="text/javascript">
                        function googleTranslateElementInit() {
                            new google.translate.TranslateElement({
                                pageLanguage: 'en',
                                includedLanguages: 'en,ar,fr',
                                autoDisplay: false,
                                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                            }, 'google_translate_element');
                        }
                    </script>
                    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                    <script>
                        $('document').ready(function () {
                            $('#google_translate_element').on("click", function () {

                            // Change font family and color
                            $("iframe").contents().find(".goog-te-menu2-item div, .goog-te-menu2-item:link div, .goog-te-menu2-item:visited div, .goog-te-menu2-item:active div").css({'color': '#000','background-color': '#FFF','font-size':'13px',});

                            // Change hover effects  #FFF = white
                            $("iframe").contents().find(".goog-te-menu2-item div").hover(function () {
                                $(this).css('background-color', '#FFF').find('span.text').css('color', '#000',);
                            }, function () {
                                $(this).css('background-color', '#FFF').find('span.text').css('color', '#000',);
                            });

                            // Change Google's default blue border
                            $("iframe").contents().find('.goog-te-menu2').css({'border': '1px solid #DDD','background-color': '#FFF','padding':'2px','border-radius': '3px','box-shadow': '0 0 3px rgba(86, 96, 117, 0.7)','font-size':'13px','font-family':'open sans',});
                            $("iframe").contents().find('.skiptranslate div, .goog-te-gadget-simple').addClass('dropdown');

                            // Change the iframe's box shadow
                            $("iframe").contents().find(".goog-te-menu2-item-selected div, .goog-te-menu2-item-selected:link div, .goog-te-menu2-item-selected:visited div, .goog-te-menu2-item-selected:active div").css({'color' : '#000','font-size':'13px','font-family':'open sans',});

                            $("iframe").contents().find(".goog-te-menu2-item-selected").css({'text-align': 'center','border-bottom': '1px solid #DDD !important','display': 'block','border-bottom': '1px solid #DDD','font-size':'13px','font-family':'open sans',});

                            $("iframe").contents().find(".goog-te-menu2-item").css({'text-align': 'center','border-bottom': '1px solid #DDD !important','display': 'block','border-bottom': '1px solid #DDD','font-size':'13px','font-family':'open sans',});

                            $(".goog-te-menu-frame").css({'position': 'absolute','top': '66.5px;','-moz-box-shadow': '0px 0px 0px #0e4373','-webkit-box-shadow': '0px 0px 0px #0e4373','box-shadow': '0px 0px 0px #0e4373','font-size':'13px','font-family':'open sans',});
                            });
                        });
                    </script>
                </div>
                <div class="setings-item">
                    <h4>Themes Settings</h4>
                    <div class="row">
                        <?php
                        $all = \App\Themes::where('id','1')->first();
                        ?>
                        <div class="col">
                            <div style="border:4px solid #f1f1f1;width: 50px;">
                                <div style="height:50px;margin:auto;background:#0f4373" data-id="1" value="#0f4373" class="w3-display-container themes" id="themes">
                                    <i class="fa fa-check" aria-hidden="true" style="color:#FFF; display:<?php if($all->color == "#0f4373"){ echo "block"; } else { echo "none"; }?>"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div style="border:4px solid #f1f1f1;width: 50px;">
                                <div style="height:50px;margin:auto;background:#f15e2d" data-id="1" value="#f15e2d" class="w3-display-container themes" id="themes">
                                    <i class="fa fa-check" aria-hidden="true" style="color:#FFF; display:<?php if($all->color == "#f15e2d"){ echo "block"; } else { echo "none"; }?>"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div style="border:4px solid #f1f1f1;width: 50px;">
                                <div style="height:50px;margin:auto;background:#fcdc25" data-id="1" value="#fcdc25" class="w3-display-container themes" id="themes">
                                    <i class="fa fa-check" aria-hidden="true" style="color:#FFF; display:<?php if($all->color == "#fcdc25"){ echo "block"; } else { echo "none"; }?>"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidebar-content">
                    <h4>Settings</h4>
                    <div class="small">I belive that. Lorem Ipsum is simply dummy text of the printing and typesetting industry.And typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).on("click",".themes",function(e){
        var row = $(this);
        var id = $(this).attr('data-id');
        var value = $(this).attr('value');
        swal({
            title: "Are you sure?",
            text: "You want's to update this record status ",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#e69a2a",
            confirmButtonText: "Yes, updated it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:"{{ route('admin.themes.change_themes','replaceid') }}",
                    type: 'post',
                    data: {"_method": 'post',
                        'id':id,
                        'value':value,
                        "_token": "{{ csrf_token() }}"
                    },
                success:function(msg){
                    if(msg.status_code == 200){
                        swal("Warning!", msg.message, "warning");
                    }else{

                        location.reload();
                    }
                },
                error:function(){
                    swal("Error!", 'Error in updated Record', "error");
                }
            });
                //swal("Updated!", "Status has been updated.", "success");

            } else {
                swal("Cancelled", "Your Status is safe :)", "error");
            }
        });
        return false;
    })
</script>