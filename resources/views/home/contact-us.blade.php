@extends('layouts.front.front-layout')
@section('title', 'NEWSROOM - CONTACT US')
@section('content')

@section('breadcrumb')
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="container">
        <nav class="breadcrumb bg-transparent m-0 p-0">
            <a class="breadcrumb-item" href="#">Home</a>
            <a class="breadcrumb-item" href="#">Contact</a>
        </nav>
    </div>
</div>
<!-- Breadcrumb End -->
@endsection

<!-- Contact Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Contact Us For Any Queries</h3>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="bg-light mb-3" style="padding: 30px;">
                    <h6 class="font-weight-bold">Get in touch</h6>
                    <p>Labore ipsum ipsum rebum erat amet nonumy, nonumy erat justo sit dolor ipsum sed, kasd lorem sit et duo dolore justo lorem stet labore, diam dolor et diam dolor eos magna, at vero lorem elitr</p>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa fa-2x fa-map-marker-alt text-primary mr-3"></i>
                        <div class="d-flex flex-column">
                            <h6 class="font-weight-bold">Our Office</h6>
                            <p class="m-0">123 Street, New York, USA</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa fa-2x fa-envelope-open text-primary mr-3"></i>
                        <div class="d-flex flex-column">
                            <h6 class="font-weight-bold">Email Us</h6>
                            <p class="m-0">info@example.com</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-2x fa-phone-alt text-primary mr-3"></i>
                        <div class="d-flex flex-column">
                            <h6 class="font-weight-bold">Call Us</h6>
                            <p class="m-0">+012 345 6789</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="contact-form bg-light mb-3" style="padding: 30px;">
                    <form action="{{route('contact.send')}}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="control-group">
                                    <input type="text" class="form-control p-4" name="name" placeholder="Your Name" required="required"/>
                                    @error('name')
                                    <p class="help-block text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="control-group">
                                    <input type="email" class="form-control p-4" name="email" placeholder="Your Email" required="required"/>
                                    @error('email')
                                    <p class="help-block text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="control-group mb-3 mt-3">
                            <input type="text" class="form-control p-4" name="phone" placeholder="Phone Number" required="required" />
                            @error('phone')
                            <p class="help-block text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control p-4" name="subject" placeholder="Subject" required="required"></p>
                            @error('subject')
                            <p class="help-block text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="control-group">
                            <textarea class="form-control" rows="4" name="message" placeholder="Message" required="required"></textarea>
                            @error('message')
                            <p class="help-block text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-primary font-weight-semi-bold px-4" style="height: 50px;" type="submit" id="sendMessageButton">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

@endsection