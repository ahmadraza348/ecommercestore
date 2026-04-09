@extends('frontend.layouts.layout')
@section('content')    
<div class="wrapper box-layout">
    
        <!-- contact area start -->
        <div class="contact-area pb-34 pb-md-18 pb-sm-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="contact-message">
                            <form action="{{ route('user.contact.submit') }}" method="post" class="contact-form">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <input name="name" placeholder="Name *" type="text" required value="{{ old('name') }}">   
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror 
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <input name="phone" placeholder="Phone *" type="text" required value="{{ old('phone') }}">  
                                        @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror 
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <input name="email" placeholder="Email *" type="text" required value="{{ old('email') }}">    
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <input name="subject" placeholder="Subject *" type="text" value="{{ old('subject') }}">   
                                        @error('subject')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                <div class="col-12">
                                        <div class="contact2-textarea text-center">
                                            <textarea placeholder="Message *" name="message"  class="form-control2" required="">{{ old('message') }}</textarea>     
                                            @error('message')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>   
                                        <div class="contact-btn">
                                            <button class="sqr-btn" type="submit">Send Message</button> 
                                        </div> 
                                    </div> 
                                    <div class="col-12 d-flex justify-content-center">
                                        <p class="form-messege"></p>
                                    </div>
                                </div>
                            </form>    
                        </div> 
                    </div>                   
                </div>
            </div>
        </div>
        <!-- contact area end -->

</div>
@endsection
