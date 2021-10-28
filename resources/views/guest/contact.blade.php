@extends('layouts.app')
@section('content')
<form method="POST" action="{{ route('guest.contact') }}" class="container pb-4">
    @csrf
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" placeholder="Enter your name" v-model="email.name" name="name">
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Email address</label>
      <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Enter your email address" v-model="email.mail_address" name='mail_address'>
    </div>
    <div class="form-group">
      <label for="message">Message</label>
      <textarea class="form-control" id="message" rows="3" v-model="email.message" name="message"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Send</button>
</form>
@endsection