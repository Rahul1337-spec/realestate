<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

@component('mail::message')
<div class="container">
    <div class="card">
        <h1 style="text-align:center;font-size:34px">Hi {{ $data[0]->name }}</h1>
        <div style="padding:10px">
            <h3 style="font-size:26px;text-align:center">A Client has contacted you for one of your property</h3>
        </div>
    </div>
</div>

@component('mail::button', ['url' => 'http://realeastate.devs/agent/manage'])
Manage Property
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
