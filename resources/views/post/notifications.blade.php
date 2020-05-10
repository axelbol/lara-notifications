@extends('layouts.admin')

@section('content')
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">Unread Notifications</div>
            <div class="card-body">

              @if (auth()->user())
              @forelse ($postNotifications as $notification)
              <div class="alert alert-default-warning">
                Post title: {{ $notification->data['title'] }}
                <p>{{ $notification->created_at->diffForHumans() }}</p>
                <button type="submit" class="mark-as-read btn btn-sm btn-dark" data-id="{{ $notification->id }}">Mark as read</button>
              </div>
              @if ($loop->last)
                <a href="#" id="mark-all">Mark all as read</a>
                  
              @endif
              
              @empty
                There are no notifications                  
              @endforelse
                          
              @endif
                            
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('scripts')
<script>
  function sendMarkRequest(id = null){
    return $.ajax("{{ route('markNotification') }}", {
      method: 'POST',
      data: {
        _token: "{{ csrf_token() }}",
        id
      }
    });
  }

  $(function(){
    $('.mark-as-read').click(function(){
      let request = sendMarkRequest($(this).data('id'));

      request.done(() => {
        $(this).parents('div.alert').remove();
      });
    });

    $('#mark-all').click(function(){
      let request = sendMarkRequest();

      request.done(() => {
        $('div.alert').remove();
      })
    });
  });
</script>
@endsection