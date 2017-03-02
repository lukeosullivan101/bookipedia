<div class="row">
<div class="message-block">
     @if (Session::has('message'))
      <div class="flash alert-info col-md-offset-3 col-md-6">
        <p class="panel-body">
          {{ Session::get('message') }}
        </p>
      </div>
      @endif
</div><!-- Container Div -->
</div>