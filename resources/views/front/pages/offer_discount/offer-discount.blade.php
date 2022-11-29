@extends('front.layouts.app')
@section('title', 'Offer Discount')
@section('mainContent')
    <div class="container">
        <div class="benefits-to">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="sec-title">Benefits To <br> <span class="color-red">Refer a Friend!</span> <img src="{{asset('images/plane-right.png') }}" alt=""></div>
                    <p>Cheesy feet camembert de normandie danish fontina. Caerphilly pecorino when the cheese comes out everybody's happy pecorino pepper jack pepper jack airedale swiss. Chalk and cheese queso mascarpone edam croque monsieur camembert de normandie rubber cheese camembert de normandie. Macaroni cheese paneer queso cheese on toast cheesecake stilton.</p>
                </div>
                <div class="col-md-7">
                    <div class="benefits-to-img">
                        <img src="{{asset('images/benifit.png') }}" alt="">
                    </div>
                </div>
            </div>
            {!!
                Form::open([
                'route' => ['front.refer'],
                'files' => 'true'
                ])
            !!}
            @csrf
            <div class="refer-friend">
               
                <div class="rf-left">
                    <div class="invite-gmail">
                        <a href="#" class="invite-gmail-btn">
                            <i class="fa fa-envelope" aria-hidden="true"></i> Invite Gmail Contacts
                        </a>
                        <div class="or">Or</div>
                        <div class="separate-emails">
                            <input type="text" class="form-control" placeholder="Your Email Id" name="email">
                            <p>Separate emails with commas</p>
                         @if($errors->has('email'))
                         <div class="help-block">
                            <strong style="color:red;">{{ $errors->first('email')  }}</strong>
                        </div>
                        @endif
                        </div>
                    </div>
                    <div class="rf-left-botm">
                        <div class="form-group">
                            <label>Your Invite Link</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="myInput" placeholder="http://urgentevisa.aistechnolabs.xyz/" value="http://urgentevisa.aistechnolabs.xyz/{{Auth::user()->unique_id}}">
                                <div class="input-group-append">
                                    <button class="btn" type="submit" onclick="myFunction()">Copy</button>
                                </div>
                            </div>
                        </div>
                        <div class="share-social">
                            <label>Share Via Social</label>
                            <ul class="follow-us-ul">
                                <li>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=http://urgentevisa.aistechnolabs.xyz&t=urgentevisa" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Facebook">
                                        <i class="fa fa-facebook" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="whatsapp-white" href="https://web.whatsapp.com/send?text=http://urgentevisa.aistechnolabs.xyz/{{Auth::user()->unique_id}}" data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on whatsapp">
                                        <img src="{{asset('images/whatsapp-icon-white.png') }}" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=http://urgentevisa.aistechnolabs.xyz&t=urgentevisa" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Linkedin">
                                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="rf-right">
                    <button type="submit" class="arrow-btn bon">
                        <span class="ab-text">Refer a Friend</span>
                        <img src="{{asset('images/right-arrow-white.png') }}" alt="">
                    </button>

                    
                    <a href="#preview-email-modal" data-toggle="modal">Preview Email</a>
                </div>
            </div>
        {!! Form::close() !!}

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="sec-title">Benefits to  <br> Apply again  <img src="{{asset('images/plane-right.png') }}" alt=""></div>
                <p>Cheesy feet camembert de normandie danish fontina. Caerphilly pecorino when the cheese comes out everybody's happy pecorino pepper jack pepper jack airedale swiss.</p>
                <a href="#" class="arrow-btn mt-2">
                    <span class="ab-text">Apply Again</span>
                    <img src="{{asset('images/right-arrow-white.png') }}" alt="">
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Preview Email start -->
<div class="modal fade" id="preview-email-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Preview Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table style="border-collapse:collapse;border-spacing:0!important;margin:0 auto; max-width:600px" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <tr>
                            <td valign="top">
                                <table style="border-collapse:collapse;border-spacing:0!important;" cellspacing="0" cellpadding="0" width="100%" border="0" >
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table width="100%">
                                                    <tr>
                                                        <td align="center"><img src="{{asset('images/blog-1.jpg') }}" alt="" style="width:100%; max-width:100%;"></td>
                                                    </tr>
                                                </table>
                                                <table width="100%" style="background-color:#f1f1f1; margin-top: -7px;">
                                                    <tr>
                                                        @if(!empty(Auth::user()->avatar))
                                                        <td align="center"><img src="{!!  \Auth::user()->avatar !== '' ? asset("storage/avatar/".\Auth::user()->avatar) : asset('storage/avatar/default.png') !!}" alt="user-img" style="border-radius: 50%; width: 100px; height: 100px; margin:15px 0"></td>
                                                        @else
                                                        <td align="center"><img src="{!! asset('storage/avatar/default.png') !!}" alt="user-img" style="border-radius: 50%; width: 100px; height: 100px; margin:15px 0"></td>
                                                        @endif
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style="color: #0f4373; font-family: Avenir,Helvetica,Arial,sans-serif; font-size: 24px; line-height: normal; font-weight: 600; padding-bottom: 10px;">{{\Auth::user()->name}} Urgent E-visa</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style="color: #282828; font-family: Avenir,Helvetica,Arial,sans-serif; font-size:16px; line-height: 22px; padding:0 25px 20px; ">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center"><a href="#" style="color: #fff; font-family: Avenir,Helvetica,Arial,sans-serif; font-size: 16px; line-height: normal; padding: 13px 25px; display: inline-block; background-color: #0f4373; font-weight: 600; text-decoration: none; margin:50px 0 30px;">Browse Services On Fiverr</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center"><img src="{{asset('images/thanks.jpg') }}" alt=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style="color: #0f4373; font-family: Avenir,Helvetica,Arial,sans-serif; font-size:18px; line-height: normal; padding: 0 0 25px 0;  ">The Urgent E-visa Team</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}
</script>