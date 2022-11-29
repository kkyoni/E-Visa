<header>
    <div class="header-top">
        <div class="container">
            <div class="ht-left">
                <div class="top-whatsapp">Need help? Chat with us on <a href="#">+{{Settings::get('whatsapp_number')}}</a></div>
            </div>
            <div class="ht-right">
                @auth
                <?php
                $notifiction_all = \App\Notifiction::where('user_id',Auth::id())->first();
                $notifiction_passport_expiry =  \App\User::where('id',Auth::id())->first();

                $passport_expiry_date = new DateTime($notifiction_passport_expiry->passport_expiry_date);
                $avatar_expiry_date = new DateTime($notifiction_passport_expiry->avatar_date);
                // dd($avatar_expiry_date);
                $today = new Datetime(date('Y-m-d'));
                #Passport Expiry Date
                if($today > $passport_expiry_date){
                $diff = $today->diff($passport_expiry_date);
                if($diff->y > 0){
                    $year = $diff->y.' years';
                } else {
                    $year = '';
                }
                if($diff->m > 0){
                    $month = $diff->m.' month';
                } else {
                    $month = '';
                }
                if($diff->d > 0){
                    $days = $diff->d.' days';
                } else {
                    $days ='';
                }
                $passport_expiry = 'Your Passport will be expired in '. $year. $month. $days;
                }




                #Profile Images Expiry Date
                if($today > $avatar_expiry_date){
                    // dd("in");
                $diff = $today->diff($avatar_expiry_date);
                if($diff->y > 0){
                    $year = $diff->y.' years';
                } else {
                    $year = '';
                }
                if($diff->m > 0){
                    $month = $diff->m.' month';
                } else {
                    $month = '';
                }
                if($diff->d > 0){
                    $days = $diff->d.' days';
                } else {
                    $days ='';
                }
                $avatar_expiry = 'You have not changed your profile image since '. $year. $month. $days .' Change it now.';
                } 
                ?>
                <div class="dropdown home-notification">
                    <a class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o" aria-hidden="true"></i></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @if(!empty($notifiction_all) && $notifiction_all->passport_expiry == "active")
                        @if(!empty($passport_expiry))
                        <a class="dropdown-item" href="#">
                        {{$passport_expiry}}</a>
                        @endif
                        @endif

                        @if(!empty($notifiction_all) && $notifiction_all->profile_image_update == "active")
                        @if(!empty($avatar_expiry))
                        <a class="dropdown-item" href="#">{{$avatar_expiry}} </a>
                        @endif
                        @endif
                        <a class="dropdown-item view-all" href="#">View all</a>
                    </div>
                </div>

                    <!-- profile start -->

                     <div class="dropdown home-account">
                        <a class="btn dropdown-toggle" data-toggle="dropdown">My Account</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('front.profile') }}">Profile Settings</a>
                            <a class="dropdown-item" href="{{ route('front.logout') }}">Logout</a>
                        </div>
                    </div>
                    <!-- <div class="dropdown home-account">
                        <a class="btn dropdown-toggle" data-toggle="dropdown">AED</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">USD</a>
                            <a class="dropdown-item" href="#">EUR</a>
                            <a class="dropdown-item" href="#">AUD</a>
                        </div>
                    </div>
                    <div class="dropdown home-account">
                        <a class="btn dropdown-toggle" data-toggle="dropdown">English</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Arabic</a>
                            <a class="dropdown-item" href="#">Spanish</a>
                        </div>
                    </div> -->

                @endauth
                @guest
                    <div class="dropdown home-account">
                        <a href="#login-modal" data-toggle="modal" class="btn" style="color: #fff; margin-right:-13px;">Login</a>
                    </div>
                @endguest
                <div class="dropdown home-account">
                        <a class="btn dropdown-toggle" data-toggle="dropdown">AED</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">USD</a>
                            <a class="dropdown-item" href="#">EUR</a>
                            <a class="dropdown-item" href="#">AUD</a>
                        </div>
                </div>
                <div id="google_translate_element"></div>
                <script type="text/javascript">
                    function googleTranslateElementInit() {
                        new google.translate.TranslateElement({
                            pageLanguage: 'en',
                            includedLanguages: 'en,ar,fr',
                            autoDisplay: true,
                            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                        }, 'google_translate_element');
                    }
                </script>
                <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                <script>
                    $('document').ready(function () {
                        $('#google_translate_element').on("click", function () {

                        // Change font family and color
                        $("iframe").contents().find(".goog-te-menu2-item div, .goog-te-menu2-item:link div, .goog-te-menu2-item:visited div, .goog-te-menu2-item:active div").css({'color': '#FFF','background-color': '#0F4373','font-size':'13px','font-family':'Conv_GothamBook',});
                        // Change hover effects  #0F4373 = white
                        $("iframe").contents().find(".goog-te-menu2-item div").hover(function () {
                            $(this).css('background-color', '#0F4373').find('span.text').css('color', '#fcdc25',);
                        }, function () {
                            $(this).css('background-color', '#0F4373').find('span.text').css('color', '#FFF');
                        });

                        // Change Google's default blue border
                        $("iframe").contents().find('.goog-te-menu2').css({'border': '1px solid #17548d','background-color': '#0F4373','padding':'2px','font-size':'13px','font-family':'Conv_GothamBook',});
                        $("iframe").contents().find('.skiptranslate div, .goog-te-gadget-simple').addClass('dropdown');
                        // Change the iframe's box shadow
                        $("iframe").contents().find(".goog-te-menu2-item-selected div, .goog-te-menu2-item-selected:link div, .goog-te-menu2-item-selected:visited div, .goog-te-menu2-item-selected:active div").css({'color' : '#fcdc25','font-size':'13px','font-family':'Conv_GothamBook',});

                        $("iframe").contents().find(".goog-te-menu2-item-selected").css({'text-align': 'center','border-bottom': '1px solid #206190 !important','display': 'block','border-bottom': '1px solid #206190','font-size':'13px','font-family':'Conv_GothamBook',});
                        $("iframe").contents().find(".goog-te-menu2-item").css({'text-align': 'center','border-bottom': '1px solid #206190 !important','display': 'block','border-bottom': '1px solid #206190','font-size':'13px','font-family':'Conv_GothamBook',});
                        $(".goog-te-menu-frame").css({'position': 'absolute','top': '40px;','-moz-box-shadow': '0px 0px 0px #0e4373','-webkit-box-shadow': '0px 0px 0px #0e4373','box-shadow': '0px 0px 0px #0e4373','font-size':'13px','font-family':'Conv_GothamBook',});
                        });
                    });

                </script>
                <!-- profile end -->
            </div>
        </div>
    </div>

