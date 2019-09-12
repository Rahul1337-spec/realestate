@hasrole('admin')
<div class="col-md-3">
    <div class="card">
        <div class="card-header">{{ $user->name }}</div>
        <div class="card-body">
            <ul class="list-group-item list-unstyled">
                <a href="{{ route('admin.approval') }}"><li class="nav-item">New Agent Request<span style="color:red">({{ $agents }})</span></li></a>
                <li class="nav-item">second</li>
                <a href="{{ route('/') }}"><li class="nav-item">Dashboard</li></a>
            </ul>
        </div>
    </div>
</div> 
@endhasrole