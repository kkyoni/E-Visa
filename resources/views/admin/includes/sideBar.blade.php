<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img src="{{ url(\Settings::get('slider_logo')) }}" alt="" style="float: right; margin-right: -12px;">
                </div>
                <div class="logo-element">
                    <a href="{{Route('admin.dashboard')}}">
                        <img alt="image" class="rounded-circle" src="{{ url(\Settings::get('favicon_logo')) }}"  height="60px" width="60px" style="border-radius:20%!important"/>
                    </a>
                </div>
            </li>
            

            <li class="@if(Request::segment('2') == 'dashboard') active @endif">
                <a href="{{ route('admin.dashboard') }}" data-toggle="tooltip" title="Dashboard">
                    <i class="fa fa-home"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            @php
            $userPermission = \App\Helpers\Helper::checkPermission(['user-list','user-create','user-edit','user-delete']);
            $rolePermission = \App\Helpers\Helper::checkPermission(['role-list','role-create','role-edit','role-delete']);
            @endphp
            @if($userPermission || $rolePermission)
            <li class="@if(Request::segment('2') == 'user' || Request::segment('2') == 'role') active @endif">
                <a href="#" data-toggle="tooltip" title="User Management">
                    <i class="fa fa-users"></i>
                    <!-- <i class="fas fa-users"></i> -->
                    <span class="nav-label">Customer Management</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    @php
                    $userPermission = \App\Helpers\Helper::checkPermission(['user-list','user-create','user-edit','user-delete']);
                    @endphp
                    @if($userPermission)
                    <li class="@if(Request::segment('2') == 'user') active @endif">
                        <a href="{{ route('admin.index') }}" data-toggle="tooltip" title="User Management">
                            <i class="fa fa-users"></i>
                            <span class="nav-label">Customer </span>
                        </a>
                    </li>
                    @endif
                    @php
                    $rolePermission = \App\Helpers\Helper::checkPermission(['role-list','role-create','role-edit','role-delete']);
                    @endphp
                    @if($rolePermission)
                    <li class="@if(Request::segment('2') == 'role') active @endif">
                        <a href="{{ route('admin.role.index') }}" data-toggle="tooltip" title="Role Management">
                            <i class="fa fa-tasks"></i>
                            <span class="nav-label">User Management</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            @php
            $countrywisevisa = \App\Helpers\Helper::checkPermission(['countrywisevisa-list','countrywisevisa-create','countrywisevisa-edit','countrywisevisa-delete']);
            $countryPermission = \App\Helpers\Helper::checkPermission(['country-list','country-create','country-edit','country-delete']);
            @endphp
            @if($countrywisevisa || $countryPermission)
            <li class="@if(Request::segment('2') == 'country_visa' || Request::segment('2') == 'country') active @endif">
                <a href="#" data-toggle="tooltip" title="Country Management">
                    <i class="fa fa-globe" aria-hidden="true"></i>
                    <span class="nav-label">Country Management</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    @php
                    $countryPermission = \App\Helpers\Helper::checkPermission(['country-list','country-create','country-edit','country-delete']);
                    @endphp
                    @if($countryPermission)
                    <li class="@if(Request::segment('2') == 'country') active @endif">
                        <a href="{{ route('admin.country.index') }}" data-toggle="tooltip" title="Country Management">
                            <i class="fa fa-map-marker"></i>
                            <!-- <i class="fas fa-map-marker-alt"></i> -->
                            <span class="nav-label">Country</span>
                        </a>
                    </li>
                    @endif
                    @php
                    $countrywisevisa = \App\Helpers\Helper::checkPermission(['countrywisevisa-list','countrywisevisa-create','countrywisevisa-edit','countrywisevisa-delete']);
                    @endphp
                    @if($countrywisevisa)
                    <li class="@if(Request::segment('2') == 'country_visa') active @endif">
                        <a href="{{ route('admin.country_visa.index') }}" data-toggle="tooltip" title="Country Wise Visa">
                            <i class="fa fa-map" aria-hidden="true"></i>
                            <!-- <i class="fas fa-map-marked-alt"></i> -->
                            <span class="nav-label">Country Wise Visa</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            @php
            $visaPermission = \App\Helpers\Helper::checkPermission(['visa-list','visa-create','visa-edit','visa-delete']);
            $visaTypePermission = \App\Helpers\Helper::checkPermission(['visatype-list','visatype-create','visatype-edit','visatype-delete']);
            @endphp
            @if($visaPermission || $visaTypePermission)
            <li class="@if(Request::segment('2') == 'visatypes' || Request::segment('2') == 'visa_type_entry') active @endif">
                <a href="#" data-toggle="tooltip" title="Visa Management">
                    <i class="fa fa-cc-visa" aria-hidden="true"></i>
                    <span class="nav-label">Visa Management</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    @php
                    $visaPermission = \App\Helpers\Helper::checkPermission(['visa-list','visa-create','visa-edit','visa-delete']);
                    @endphp
                    @if($visaPermission)
                    <li class="@if(Request::segment('2') == 'visatypes') active @endif">
                        <a href="{{ route('admin.visa_types.index') }}" data-toggle="tooltip" title="Visa Type">
                            <i class="fa fa-cc-visa"></i>
                            <span class="nav-label">Visa Type</span>
                        </a>
                    </li>
                    @endif
                    @php
                    $visaTypePermission = \App\Helpers\Helper::checkPermission(['visatype-list','visatype-create','visatype-edit','visatype-delete']);
                    @endphp
                    @if($visaTypePermission)
                    <li class="@if(Request::segment('2') == 'visa_type_entry') active @endif">
                        <a href="{{ route('admin.visa_type_entry.index') }}" data-toggle="tooltip" title="Visa Type Entries">
                            <i class="fa fa-flag"></i>
                            <span class="nav-label">Visa Type Entries</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            @php
            $embassyPermission = \App\Helpers\Helper::checkPermission(['emb-list','emb-create','emb-edit','emb-delete']);
            @endphp
            @if($embassyPermission)
            <li class="@if(Request::segment('2') == 'embassy') active @endif">
                <a href="{{ route('admin.embassy.index') }}" data-toggle="tooltip" title="Embassy Management">
                    <i class="fa fa-building"></i>
                    <span class="nav-label">Embassy Management</span>
                </a>
            </li>
            @endif

            @php
            $pricePermission = \App\Helpers\Helper::checkPermission(['price-list','price-create','price-edit','price-delete']);
            @endphp
            @if($pricePermission)
            <li class="@if(Request::segment('2') == 'prices') active @endif">
                <a href="{{ route('admin.prices.index') }}" data-toggle="tooltip" title="Price Management">
                    <i class="fa fa-money"></i>
                    <span class="nav-label">Price Management</span>
                </a>
            </li>
            @endif

            @php
            $orderPermission = \App\Helpers\Helper::checkPermission(['order-list']);
            @endphp
            @if($orderPermission)
            <li class="@if(Request::segment('2') == 'order' || Request::segment('2') == 'order-show') active @endif">
                <a href="{{ route('admin.order.index') }}" data-toggle="tooltip" title="Role Management">
                    <i class="fa fa-universal-access"></i>
                    <span class="nav-label">Order Status</span>
                </a>
            </li>
            @endif

            @php
            $questionPermission = \App\Helpers\Helper::checkPermission(['questionPermission-list','questionPermission-create','questionPermission-edit','questionPermission-delete']);
            @endphp
            @if($questionPermission)
            <li class="@if(Request::segment('2') == 'pre' || Request::segment('2') == 'post') active @endif">
                <a href="#" data-toggle="tooltip" title="Question Management">
                    <i class="fa fa-question-circle"></i>
                    <span class="nav-label">Question Management</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="@if(Request::segment('2') == 'pre') active @endif">
                        <a href="{{route('admin.pre.index')}}" data-toggle="tooltip" title="Pre Payment Question">
                            <i class="fa fa-question-circle"></i>
                            <span class="nav-label font_size">Pre Payment Question</span>
                        </a>
                    </li>
                    <li class="@if(Request::segment('2') == 'post') active @endif">
                        <a href="{{route('admin.post.index')}}" data-toggle="tooltip" title="Post Payment Question">
                            <i class="fa fa-question-circle"></i>
                            <span class="nav-label font_size">Post Payment Question</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @php
            $referralPermission = \App\Helpers\Helper::checkPermission(['referral-list','referral-create','referral-edit','referral-delete']);
            @endphp
            @if($referralPermission)
            <li class="@if(Request::segment('2') == 'referral') active @endif">
                <a href="{{ route('admin.referral_index') }}" data-toggle="tooltip" title="Referral Management">
                    <i class="fa fa-paper-plane"></i>
                    <span class="nav-label">Referral Management</span>
                </a>
            </li>
            @endif

            @php
            $transaction = \App\Helpers\Helper::checkPermission(['transaction-list','transaction-create','transaction-edit','transaction-delete']);
            @endphp
            @if($transaction)
            <li class="@if(Request::segment('2') == 'transaction' || Request::segment('2') == 'visa_approval' || Request::segment('2') == 'visa_reject') active @endif">
                <a href="#" data-toggle="tooltip" title="Report Management">
                    <i class="fa fa-money"></i>
                    <span class="nav-label">Report Management</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="@if(Request::segment('2') == 'transaction') active @endif">
                        <a href="{{ route('admin.transaction.index') }}" data-toggle="tooltip" title="Transaction Report">
                            <i class="fa fa-hourglass"></i>
                            <span class="nav-label font_size">Transaction Report</span>
                        </a>
                    </li>
                    <li class="@if(Request::segment('2') == 'visa_approval') active @endif">
                        <a href="{{ route('admin.visa_approval.visa_approval_index') }}" data-toggle="tooltip" title="Visa approval Report">
                            <i class="fa fa-check"></i>
                            <span class="nav-label font_size">Visa approval Report</span>
                        </a>
                    </li>
                    <li class="@if(Request::segment('2') == 'visa_reject') active @endif">
                        <a href="{{ route('admin.visa_reject.visa_reject_index') }}" data-toggle="tooltip" title="Visa Rejected Report">
                            <i class="fa fa-ban"></i>
                            <span class="nav-label font_size">Visa Rejected Report</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @php
            $cmsFaqs = \App\Helpers\Helper::checkPermission(['cms-list','cms-create','cms-edit','cms-delete','faq-list','faq-create','faq-edit','faq-delete']);
            @endphp
            @if($cmsFaqs)
            <li class="@if(Request::segment('2') == 'cms' || Request::segment('2') == 'faq') active @endif">
                <a href="#" data-toggle="tooltip" title="CMS Management">
                    <i class="fa fa-clipboard"></i>
                    <span class="nav-label">CMS Management</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    @php
                    $cmsFaqs = \App\Helpers\Helper::checkPermission(['cms-list','cms-create','cms-edit','cms-delete']);
                    @endphp
                    @if($cmsFaqs)
                    <li class="@if(Request::segment('2') == 'cms') active @endif">
                        <a href="{{ route('admin.cms.index') }}" data-toggle="tooltip" title="CMS Page">
                            <i class="fa fa-file-o"></i>
                            <span class="nav-label font_size">CMS Page</span>
                        </a>
                    </li>
                    @endif

                    @php
                    $faqs = \App\Helpers\Helper::checkPermission(['faq-list','faq-create','faq-edit','faq-delete']);
                    @endphp
                    @if($faqs)
                    <li class="@if(Request::segment('2') == 'faq') active @endif">
                        <a href="{{ route('admin.faq.index') }}" data-toggle="tooltip" title="FAQ">
                            <i class="fa fa-question-circle"></i>
                            <span class="nav-label font_size">FAQ</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            @php
            $blogPermission = \App\Helpers\Helper::checkPermission(['blog-list','blog-create','blog-edit','blog-delete']);
            @endphp
            @if($blogPermission)
            <li class="@if(Request::segment('2') == 'blog') active @endif">
                <a href="{{ route('admin.blog.index') }}" data-toggle="tooltip" title="Blog Management">
                    <i class="fa fa-newspaper-o"></i>
                    <span class="nav-label">Blog Management</span>
                </a>
            </li>
            @endif

            @php
            $feedbackPermission = \App\Helpers\Helper::checkPermission(['feedback-list']);
            @endphp
            @if($feedbackPermission)
            <li class="@if(Request::segment('2') == 'feedback') active @endif">
                <a href="{{ route('admin.feedback.index') }}" data-toggle="tooltip" title="Feedback Management">
                    <i class="fa fa-comments-o"></i>
                    <span class="nav-label">Feedback Management</span>
                </a>
            </li>
            @endif

            @php
            $scriptsettings = \App\Helpers\Helper::checkPermission(['script-list','script-create','script-edit','script-delete']);

            $emailPermission = \App\Helpers\Helper::checkPermission(['email-template-list','email-template-create','email-template-edit','email-template-delete']);

            $settings = \App\Helpers\Helper::checkPermission(['setting-list','setting-edit']);
            @endphp
            @if($emailPermission || $scriptsettings || $settings)
            <li class="@if(Request::segment('2') == 'emailtemplates' || Request::segment('2') == 'script' || Request::segment('2') == 'settings') active @endif">
                <a href="#" data-toggle="tooltip" title="General Settings">
                    <i class="fa fa-gear"></i>
                    <span class="nav-label">General Settings</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    @php
                    $emailPermission = \App\Helpers\Helper::checkPermission(['email-template-list','email-template-create','email-template-edit','email-template-delete']);
                    @endphp
                    @if($emailPermission)
                    <li class="@if(Request::segment('2') == 'emailtemplates') active @endif">
                        <a href="{{ route('admin.emailtemplates.index') }}" data-toggle="tooltip" title="Email Templates">
                            <i class="fa fa-envelope"></i>
                            <span class="nav-label">Email Templates</span>
                        </a>
                    </li>
                    @endif
                    @php
                    $scriptsettings = \App\Helpers\Helper::checkPermission(['script-list','script-create','script-edit','script-delete']);
                    @endphp
                    @if($scriptsettings)
                    <li class="@if(Request::segment('2') == 'script') active @endif">
                        <a href="{{ url('admin/script') }}" data-toggle="tooltip" title="Script Management">
                            <i class="fa fa-code"></i>
                            <span class="nav-label">Script Management</span>
                        </a>
                    </li>
                    @endif
                    @php
                    $settings = \App\Helpers\Helper::checkPermission(['setting-list','setting-edit']);
                    @endphp
                    @if($settings)
                    <li class="@if(Request::segment('2') == 'settings') active @endif">
                        <a href="{{ url('admin/settings') }}" data-toggle="tooltip" title="Settings">
                            <i class="fa fa-cogs"></i>
                            <span class="nav-label">Settings</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
        </ul>
    </div>
</nav>
<?php
$all = \App\Themes::where('id','1')->first();
if($all->color == "#0f4373"){ ?>
<style>
.btn-primary{color: #fff; background-color: #0F4373; border-color: #0F4373;}
.btn-primary:hover, .btn-primary:focus, .btn-primary.focus {background-color: #f15e2d; border-color: #f15e2d;}
.nav-header{background: #0f4373;}
#side-menu{background: #0f4373;}
.nav > li.active{background: #f15e2d; border-left: 4px solid #fff}
.navbar-default .nav > li > a:hover, .navbar-default .nav > li > a:focus{background-color:#fcdc25;color: #000}
ul.nav-second-level {background: #0f4373;}
.nav > li > a{color:#FFF;}
body{background-color:#0f4373;}
#loader {position: absolute; left: 50%; top: 50%; z-index: 1; width: 150px; height: 150px; margin: -75px 0 0 -75px;
  border-radius: 50%; border: 16px solid #fcdc25; border-top: 16px solid #fcdc25; border-right: 16px solid #f15e2d;
  border-bottom: 16px solid #f15e2d; width: 120px; height: 120px; -webkit-animation: spin 2s linear infinite; animation: spin 2s linear infinite;}
.bars{background-color: #0e4373; border-color: #0e4373;}
.bars:hover{background-color: #f15f39; border-color: #f15f39;}
.bars:not(:disabled):not(.disabled):active, .bars:not(:disabled):not(.disabled).active, .show > .bars.dropdown-toggle{background-color: #f15f39; border-color: #f15f39;}
.bars:focus{background-color: #f15f39; border-color: #f15f39;}
</style>
<?php } elseif($all->color == "#f15e2d"){ ?>
<style>
.btn-primary{color: #fff; background-color: #f15e2d; border-color: #f15e2d;}
.btn-primary:hover, .btn-primary:focus, .btn-primary.focus {background-color: #fcdc25; border-color: #fcdc25;}
.nav-header{background: #f15e2d;}
#side-menu{background: #f15e2d;} 
.nav > li.active{background: #fcdc25; border-left: 4px solid #fff}
.navbar-default .nav > li > a:hover, .navbar-default .nav > li > a:focus{background-color:#0f4373;color: #FFF}
ul.nav-second-level {background: #f15e2d;}
.nav > li > a{color:#FFF;}
.nav > li.active > a{color:#000;}
body{background-color:#f15e2d;}
#loader {position: absolute; left: 50%; top: 50%; z-index: 1; width: 150px; height: 150px; margin: -75px 0 0 -75px; border-radius: 50%; border: 16px solid #fcdc25; border-top: 16px solid #fcdc25; border-right: 16px solid #0f4373; border-bottom: 16px solid #0f4373; width: 120px; height: 120px; -webkit-animation: spin 2s linear infinite; animation: spin 2s linear infinite;}
.bars{background-color: #f15e2d; border-color: #f15e2d;}
.bars:hover{background-color: #fcdc25; border-color: #fcdc25;}
.bars:not(:disabled):not(.disabled):active, .bars:not(:disabled):not(.disabled).active, .show > .bars.dropdown-toggle{background-color: #fcdc25; border-color: #fcdc25;}
.bars:focus{background-color: #fcdc25; border-color: #fcdc25;}
</style>
<?php } elseif($all->color == "#fcdc25"){ ?>
<style>
.btn-primary{color: #fff; background-color: #fcdc25; border-color: #fcdc25;}
.btn-primary:hover, .btn-primary:focus, .btn-primary.focus {background-color: #0F4373; border-color: #0F4373;}
.nav-header{background: #fcdc25;}
#side-menu{background: #fcdc25;} 
.nav > li.active{background: #0f4373; border-left: 4px solid #fff;}
.navbar-default .nav > li > a:hover, .navbar-default .nav > li > a:focus{background-color:#f15e2d;color: #000}
ul.nav-second-level {background: #fcdc25;}
.nav > li > a{color:#000;}
body{background-color:#fcdc25;}
#loader {position: absolute; left: 50%; top: 50%; z-index: 1; width: 150px; height: 150px; margin: -75px 0 0 -75px; border-radius: 50%; border: 16px solid #f15e2d; border-top: 16px solid #f15e2d; border-right: 16px solid #0f4373; border-bottom: 16px solid #0f4373; width: 120px; height: 120px; -webkit-animation: spin 2s linear infinite; animation: spin 2s linear infinite;}
.bars{background-color: #fcdc25; border-color: #fcdc25;}
.bars:hover{background-color: #0f4373; border-color: #0f4373;}
.bars:not(:disabled):not(.disabled):active, .bars:not(:disabled):not(.disabled).active, .show > .bars.dropdown-toggle{background-color: #0f4373; border-color: #0f4373;}
.bars:focus{background-color: #0f4373; border-color: #0f4373;}
</style>
<?php } ?>
<style type="text/css">
.font_size{font-size: 11px;}
/*.navbar-static-side {width: 222px;}
#page-wrapper{margin: 0 0 0 222px;}*/
.navbar-static-side {width: 232px;}
#page-wrapper{margin: 0 0 0 233px;}
.start{color: #ffffff; background-color: #f15f39; border-color: #f15f39;}
</style>