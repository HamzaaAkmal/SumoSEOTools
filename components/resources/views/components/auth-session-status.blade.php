@props(['status'])

@switch( $status )

    @case( 'success' )

		  <div class="alert alert-important alert-success text-white" role="alert">
		    {{ session('message') }}
		  </div>

        @break

    @case( 'error' )
    
		  <div class="alert alert-important alert-danger text-white" role="alert">
		    {{ session('message') }}
		  </div>

        @break

    @default

@endswitch