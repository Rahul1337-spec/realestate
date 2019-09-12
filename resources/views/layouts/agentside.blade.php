@hasrole('agent')
<div class="col-md-3">
    <div class="card">
        <div class="card-header"><h2>Agent Account</h2></div>
        <ul class="list-group">
            <a href="{{ route('agent.property') }}"><li class="list-group-item">Post Properties</li></a>
            <a href="{{ route('/') }}"><li class="list-group-item">User Account</li></a>
            <a href="{{ route('agent.manage')}}"><li class="list-group-item">Manage Property</li></a>
        </ul>
    </div>
</div>
@endhasrole