<div>
  @if(session()->has('message'))
  <div class="alert alert-success">{{session()->get('message')}}</div>
  @elseif(session()->has('error'))
  <div class="alert alert-danger">{{session()->get('error')}}</div>
  @endif
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
