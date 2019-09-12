@extends('layouts.app')
@section('content')
<main id="page-1102">
    <div class="container-fluid">
        <div class="row row__main">
          <div class="col-md-4">
           <div class="text-center"><h1>Apply For Agent Registration</h1></div>
       </div>
       @if(session()->has('success'))
       <div class="container">
        <div class="card-header">
            <div class="alert alert-danger">
                {{ session()->get('success') }}
            </div>
        </div>
    </div>
    @endif
    <div class="col-md-8">
        <div class="row row__0">
            <div class="col__0">
               <form method="POST" enctype="multipart/form-data" action="{{ route('user.regagent') }}">
                   @csrf
                   <div class="row flex-column">
                    <div class="col-md-12 col-sm-12 form-group">
                        <label>Agent Name</label>
                        <input type="text" name="agent_name" placeholder="Name or Agency Name">
                    </div>
                    <div class="col-md-12 col-sm-12 form-group">
                        <label>City</label>
                        <input type="text" name="city" placeholder="City">
                    </div>
                    <div class="col-md-12 col-sm-12 form-group">
                        <label>Address</label>
                        <input type="text" name="agent_address" placeholder="Address">
                    </div>
                    <div class="col-md-12 col-sm-12 form-group">
                        <label>Locality</label>
                        <input type="text" name="locality" placeholder="locality">
                    </div>
                </div>
                <div class="row">
                    <input type="submit" name="submit" value="apply">
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</main>



@endsection